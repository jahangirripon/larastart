<template>
    <div class="container">
        <div class="row" v-if="$gate.isAdminOrAuthor()">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add user <i class="fas fa-user-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Register at</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name | upText }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.type }}</td>
                    <td>{{ user.created_at | myDate }}</td>
                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                 <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="exampleModalLabel">Add new user</h5>
                <h5 class="modal-title" v-show="editmode" id="exampleModalLabel">Update user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" @submit.prevent="editmode ? updateUser() : createUser() ">

                <div class="modal-body">
                <!-- <form @submit.prevent="login" @keydown="form.onKeydown($event)"> -->

                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Enter your name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" placeholder="Email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.password" type="password" name="password" placeholder="password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.bio" type="" name="bio" placeholder="bio"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                        <has-error :form="form" field="bio"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="type" id="type" v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">Select user role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="author">Author</option>
                        </select>
                        
                        <has-error :form="form" field="password"></has-error>
                    </div>

                    <!-- <button :disabled="form.busy" type="submit" class="btn btn-primary">Log In</button> -->
                <!-- </form> -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>

            </form>

            </div>
        </div>
        </div>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: true,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },

            newModal() {
               // data-toggle="modal" data-target="#addNew"
               this.editMode = true;
               this.form.reset();
               $('#addNew').modal('show');
            },
            editModal(user) {

                this.editMode = !this.editmode;
               this.form.reset();
               $('#addNew').modal('show');
               this.form.fill(user);
            },

            deleteUser(id) {
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    
                    if (result.value) {
                        // send request to server to delte data
                        this.form.delete('api/user/'+id).then((result) => {
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                                })
                        });
                    }

                })
            },

            loadUsers(){
                if(this.$gate.isAdminOrAuthor()) {
                    axios.get('/api/user').then(({data}) => (this.users = data));
                    //axios.get('/api/user').then(({data}) => (this.users = data.data));
                }
            },

            updateUser() {
                // console.log('editing data');
                this.editmode = true;
                this.form.put("/api/user/"+this.form.id)
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    Swal.fire({
                                type: 'success',
                                title: 'Data updated successfully',
                                text: 'Data updated successfully'
                                });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                                })
                });
                
            },

            createUser() {
                this.$Progress.start();
                this.form.post('/api/user')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')
                        Toast.fire({
                        type: 'success',
                        title: 'User created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() =>  {
                    });
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
            // setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>
