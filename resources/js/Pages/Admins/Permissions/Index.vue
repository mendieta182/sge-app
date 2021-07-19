<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Permissions</h3>
                                    <button type="button" class="btn btn-info text-uppercase ml-1 btn-sm" style="letter-spacing: 0.1em;" @click="openModal">
                                        Create
                                    </button>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(permission,index) in permissions.data" :key="index">
                                            <td>{{ permission.name }}</td>
                                            <td>{{ permission.description }}</td>
                                            <td>{{ permission.created_at }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-warning btn-sm" style="letter-spacing: 0.1em;" @click="editModal(permission)">Edit</button>
                                                <button class="btn btn-danger btn-sm ml-1" style="letter-spacing: 0.1em;" @click="deletePermission(permission)">Delete</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <pagination :links="permissions.links"></pagination>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </section>

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content card card-outline card-success">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ formTitle }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="h6 text-warning">** All permission must start with "create: ", "read: ", "update: ", or "delete: "</p>
                            <div class="d-flex flex-column h4">
                                <span>Preview name: <span>{{ form.name }}</span> </span>
                                <span>Preview description: <span>{{ form.description }}</span> </span>
                            </div>
                        </div>
                        <div class="card card-body card-primary">
                            <form @submit.prevent="checkMode">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="h4">Permission Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Permission Name" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off">
                                    </div>
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                        {{ form.errors.name }}
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="h4">Permission Description</label>
                                        <input type="text" class="form-control" id="description" placeholder="Permission Description" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off">
                                    </div>
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                        {{ form.errors.description }}
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger text-uppercase" style="letter-spacing: 0.1em;" @click="closeModal">Cancel</button>
                                    <button type="submit" class="btn btn-info text-uppercase" style="letter-spacing: 0.1em;"
                                            :disabled="!form.name||!form.description||form.processing">
                                        {{ buttonText }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </admin-layout>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";
export default {
    props:['permissions'],
    components:{AdminLayout,Pagination},
    data(){
        return {
            editMode:false,
            editedIndex: -1,
            form: this.$inertia.form({
                id: '',
                name: '',
                description: '',
            }),
        }
    },
    computed:{
        formTitle(){
            return this.editedIndex===-1 ? 'Create New Permission':'Edit Current Permission';
        },
        buttonText(){
            return this.editedIndex===-1 ? 'Create':'Edit';
        },
        checkMode(){
            return this.editMode===false ? this.createPermission(): this.editPermission();
        }
    },
    methods:{
        editModal(permission){
            this.editMode=true
            $('#modal-lg').modal('show')
            this.editedIndex=this.permissions.data.indexOf(permission)
            this.form.name=permission.name
            this.form.id=permission.id
            this.form.description=permission.description
        },
        openModal(){
            this.form.clearErrors()
            this.editMode=false
            this.form.reset()
            this.editedIndex=-1
            $('#modal-lg').modal('show');
        },
        closeModal(){
            this.form.clearErrors()
            this.editMode=false
            this.form.reset()
            $('#modal-lg').modal('hide');
        },
        createPermission(){
            this.form.post(this.route('admin.permissions.store'),{
                preserveScroll:true,
                onSuccess:()=>{
                    this.form.reset()
                    this.closeModal()
                    Toast.fire({
                        icon:'success',
                        title:'New permission Created!'
                    })
                }
            })
        },
        editPermission(){
            this.form.patch(this.route('admin.permissions.update', this.form.id, this.form), {
                preserveScroll:true,
                onSuccess:()=>{
                    Toast.fire({
                        icon:'success',
                        title:'Permission has been updated!'
                    })
                    this.form.reset()
                    this.closeModal()
                }
            })
        },
        deletePermission(permission){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if (result.isConfirmed){
                    this.form.delete(this.route('admin.permissions.destroy',permission), {
                        preserveScroll:true,
                        onSuccess:()=>{
                            Swal.fire(
                                'Deleted!',
                                'Permission has been deleted.',
                                'success'
                            )
                        }
                    })
                }
            })
        },
    }
}
</script>
