<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
                                    <h3 class="card-title">Roles and Permissions</h3>
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
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(role,index) in roles.data" :key="index">
                                            <td>{{ role.name }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                <span v-for="(permission,index) in role.permissions" :key="index">
                                                    {{permission.name}}
                                                </span>
                                                </div>
                                            </td>
                                            <td>{{ role.created_at }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-warning btn-sm" style="letter-spacing: 0.1em;" @click="editModal(role)">Edit</button>
                                                <button class="btn btn-danger btn-sm ml-1" style="letter-spacing: 0.1em;" @click="deleteRole(role)">Delete</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <pagination :links="roles.links"></pagination>
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
                            <div class="#">
                                <span>Preview: <span class="text-capitalize">{{ form.name }}</span> </span>
                            </div>
                        </div>
                        <div class="card card-body card-primary">
                            <form @submit.prevent="checkMode">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="role" class="h4">Role Name</label>
                                        <input type="text" class="form-control" id="role" placeholder="Role Name" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off">
                                    </div>
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                        {{ form.errors.name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="permissions" class="h4">Permissions</label>
                                        <multiselect
                                            v-model="form.permissions"
                                            :options="permissionOptions"
                                            selectedLabel="Seleccionado"
                                            selectLabel="Seleccionar"
                                            deselectLabel="Quitar"
                                            :multiple="true"
                                            :taggable="true"
                                            :close-on-select="false"
                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            open-direction="bottom"
                                            placeholder="Choose permission(s)"
                                            @addPermissions="addPermissions"
                                            label="name"
                                            track-by="id"
                                        ></multiselect>
                                    </div>
                                    <div class="invalid-feedback" :class="{ 'd-block' : form.errors.permissions}">
                                        {{ form.errors.permissions }}
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger text-uppercase" style="letter-spacing: 0.1em;" @click="closeModal">Cancel</button>
                                    <button type="submit" class="btn btn-info text-uppercase" style="letter-spacing: 0.1em;"
                                            :disabled="!form.name||form.processing">
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
        props:['roles','permissions'],
        components:{AdminLayout,Pagination},
        data(){
            return {
                editMode:false,
                editedIndex: -1,
                form: this.$inertia.form({
                    id: '',
                    name: '',
                    permissions: [],
                }),
                permissionOptions:this.permissions,
            }
        },
        computed:{
            formTitle(){
                return this.editedIndex===-1 ? 'Create New Role':'Edit Current Role';
            },
            buttonText(){
                return this.editedIndex===-1 ? 'Create':'Edit';
            },
            checkMode(){
                return this.editMode===false ? this.createRole(): this.editRole();
            }
        },
        methods:{
            addPermissions(newPermission) {
                let permission = {
                    name: newPermission,
                }
                this.permissionOptions.push(permission)
                this.form.permissions.push(permission)
            },
            editModal(role){
                this.editMode=true
                $('#modal-lg').modal('show')
                this.editedIndex=this.roles.data.indexOf(role)
                this.form.name=role.name
                this.form.id=role.id
                this.form.permissions=role.permissions
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
            createRole(){
                this.form.post(this.route('admin.roles.store'),{
                    preserveScroll:true,
                    onSuccess:()=>{
                        this.form.reset()
                        this.closeModal()
                        Toast.fire({
                            icon:'success',
                            title:'New Role Created!'
                        })
                    }
                })
            },
            editRole(){
                this.form.patch(this.route('admin.roles.update', this.form.id, this.form), {
                    preserveScroll:true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon:'success',
                            title:'Role has been updated!'
                        })
                        this.form.reset()
                        this.closeModal()
                    }
                })
            },
            deleteRole(role){
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
                        this.form.delete(this.route('admin.roles.destroy',role), {
                            preserveScroll:true,
                            onSuccess:()=>{
                                Swal.fire(
                                    'Deleted!',
                                    'Role has been deleted.',
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
