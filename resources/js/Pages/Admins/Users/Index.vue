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
                                    <h3 class="card-title">{{ $page.props.language['Users']}} </h3>
                                    <button type="button" class="btn btn-info text-uppercase ml-1 btn-sm" style="letter-spacing: 0.1em;" @click="openModal">
                                        {{ $page.props.language['Create']}}
                                    </button>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            <input type="text" v-model="params.nameSearch" class="form-control float-right mr-1" placeholder="Name">
                                            <input type="text" v-model="params.emailSearch" class="form-control float-right mr-1" placeholder="Email">
                                            <select v-model="params.perPage" class="form-control form-control-sm select-sm mb-2">
                                                <option value="5">5 {{ $page.props.language['per page']}}</option>
                                                <option value="10">10 {{ $page.props.language['per page']}}</option>
                                                <option value="15">15 {{ $page.props.language['per page']}}</option>
                                                <option value="25">25 {{ $page.props.language['per page']}}</option>
                                                <option value="50">50 {{ $page.props.language['per page']}}</option>
                                                <option value="100">100 {{ $page.props.language['per page']}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ $page.props.language['Name']}}</th>
                                                <th>{{ $page.props.language['Email']}}</th>
                                                <th>Joined</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(user,index) in users.data" :key="index">
                                                <th >{{ (index+1) + $page.props.users.current_page * $page.props.users.per_page - $page.props.users.per_page }}</th>
                                                <td>{{ user.name }}</td>
                                                <td>{{ user.email }}</td>
                                                <td>{{ user.created_at }}</td>
                                                <td class="text-right">
                                                    <button class="btn btn-warning btn-sm" style="letter-spacing: 0.1em;" @click="editModal(user)">Edit</button>
                                                    <button class="btn btn-danger btn-sm ml-1" style="letter-spacing: 0.1em;" @click="deleteUser(user)">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td v-if="users.data.length === 0" colspan="4">{{ $page.props.language['No users found.']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <span class="m-0 float-left">
                                     Mostrando del {{$page.props.users.from}} al {{$page.props.users.to}} de {{$page.props.users.total}} {{ $page.props.language['Users']}}
                                    </span>
                                    <pagination :links="users.links"></pagination>
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
                                <span>Preview Name: <span class="text-capitalize">{{ form.name }}</span> </span>
                            </div>
                            <div class="#">
                                <span>Preview Email: <span class="text-capitalize">{{ form.email }}</span> </span>
                            </div>
                        </div>
                        <div class="card card-body card-primary">
                            <form @submit.prevent="checkMode">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="h4">Name</label>
                                        <input type="text" class="form-control" placeholder="User Name" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off">
                                    </div>
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                        {{ form.errors.name }}
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="h4">Email</label>
                                        <input type="email" class="form-control" placeholder="User Email" v-model="form.email" :class="{ 'is-invalid' : form.errors.email }" autocomplete="off">
                                    </div>
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.email}">
                                        {{ form.errors.email }}
                                    </div>

                                        <div class="form-group" v-if="editMode" >
                                        <label for="roles" class="h4">Roles</label>
                                        <multiselect
                                            v-model="form.roles[0]"
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
                                    <button type="button" class="btn btn-danger text-uppercase" style="letter-spacing: 0.1em;"
                                            @click="closeModal">Cancel</button>
                                    <button type="submit" class="btn btn-info text-uppercase" style="letter-spacing: 0.1em;"
                                            :disabled="!form.name||!form.email||form.processing">
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
import {pickBy} from "lodash";
export default {
    props:['roles','users','perPage','emailSearch','nameSearch'],
    components:{AdminLayout,Pagination},
    data(){
        return {
            editMode:false,
            editedIndex: -1,
            form: this.$inertia.form({
                id: '',
                name: '',
                email: '',
                roles: [],
            }),
            roleOptions:this.roles,
            params:{
                    emailSearch: this.emailSearch,
                    nameSearch: this.nameSearch,
                    perPage: this.perPage,
                }
        }
    },
    watch:{
            params:{
                handler(){
                    let params=pickBy(this.params);
                    //let params=this.params;

                    // Object.keys(params).forEach(key=>{
                    //     if (params[key] == ''){
                    //         delete params[key]
                    //     }
                    // });

                    Object.keys(params).forEach(key=>{
                        if (params.perPage == 5){
                            delete params.perPage
                        }
                        if (params.page==1){
                            delete params.page
                        }
                    });

                    this.$inertia.replace(this.route('admin.users.index',
                        params,
                        { preserveState: true, preserveScroll: true }));
                },
                deep: true,
            }
        },
    computed:{
        formTitle(){
            return this.editedIndex===-1 ? 'Create New User':'Edit Current User';
        },
        buttonText(){
            return this.editedIndex===-1 ? 'Create':'Edit';
        },
        checkMode(){
            return this.editMode===false ? this.createUser(): this.editUser();
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
        editModal(user){
            this.editMode=true
            $('#modal-lg').modal('show')
            this.editedIndex=this.users.data.indexOf(user)
            this.form.name=user.name
            this.form.email=user.email
            this.form.id=user.id
            this.form.roles=user.roles
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
        createUser(){
            this.form.post(this.route('admin.users.store'),{
                preserveScroll:true,
                onSuccess:()=>{
                    this.form.reset()
                    this.closeModal()
                    Toast.fire({
                        icon:'success',
                        title:'New User Created!'
                    })
                }
            })
        },
        editUser(){
            this.form.patch(this.route('admin.users.update', this.form.id, this.form), {
                preserveScroll:true,
                onSuccess:()=>{
                    Toast.fire({
                        icon:'success',
                        title:'User has been updated!'
                    })
                    this.form.reset()
                    this.closeModal()
                }
            })
        },
        deleteUser(user){
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
                    this.form.delete(this.route('admin.users.destroy',user), {
                        preserveScroll:true,
                        onSuccess:()=>{
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
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
