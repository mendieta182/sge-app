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
                                    <h3 class="card-title">Admins</h3>
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
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                            <th class="text-capitalize text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(admin,index) in admins.data" :key="index">
                                            <td>{{ admin.name }}</td>
                                            <td>
                                                <template v-for="role in admin.roles" :key="role.id">
                                                        {{ role.name}}
                                                </template>
                                            </td>
                                            <td>{{ admin.email }}</td>
                                            <td>{{ admin.created_at }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-warning btn-sm" style="letter-spacing: 0.1em;" @click="editModal(admin)">Edit</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <pagination :links="admins.links"></pagination>
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
                            <h4 class="modal-title">Edit Current Admins</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-body card-primary">
                                <form @submit.prevent="updateAdmins">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name" class="h4">Name</label>
                                            <input type="text" class="form-control" placeholder="User Name" v-model="form.name" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="roles" class="h4">Roles</label>
                                            <multiselect
                                                v-model="form.roles"
                                                :options="roleOptions"
                                                selectedLabel="Seleccionado"
                                                selectLabel="Seleccionar"
                                                deselectLabel="Quitar"
                                                :multiple="false"
                                                :taggable="true"
                                                :close-on-select="false"
                                                :clear-on-select="false"
                                                :preserve-search="true"
                                                open-direction="bottom"
                                                placeholder="Choose new role"
                                                @tag="addTag"
                                                label="name"
                                                track-by="id"
                                            ></multiselect>
                                        </div>
                                        <div class="invalid-feedback" :class="{ 'd-block' : form.errors.roles}">
                                            {{ form.errors.roles }}
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger text-uppercase" style="letter-spacing: 0.1em;" @click="closeModal">Cancel</button>
                                        <button type="submit" class="btn btn-info text-uppercase" style="letter-spacing: 0.1em;" >
                                            Update</button>
                                    </div>
                                </form>
                            </div>
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
    props:['roles','admins'],
    components:{AdminLayout,Pagination},
    data(){
        return {
            editedIndex: -1,
            form: this.$inertia.form({
                id: '',
                name: '',
                email: '',
                roles: [],
            }),
            roleOptions:this.roles,
        }
    },
    methods:{
        addTag(newRole) {
            let tag = {
                name: newRole,
            }
            this.roleOptions.push(tag)
            this.form.roles.push(tag)
        },
        editModal(admin){
            this.editMode=true
            $('#modal-lg').modal('show')
            this.editedIndex=this.admins.data.indexOf(admin)
            this.form.name=admin.name
            this.form.email=admin.email
            this.form.id=admin.id
            this.form.roles=admin.roles
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
        updateAdmins(){
            this.form.patch(this.route('admin.admins.update', this.form), {
                preserveScroll:true,
                onSuccess:()=>{
                    Toast.fire({
                        icon:'success',
                        title:'Admin has been updated!'
                    })
                    this.form.reset()
                    this.closeModal()
                }
            })
        },
    }
}
</script>
