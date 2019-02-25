<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background-image: url('./img/profile-cover.png')">
                                <h3 class="widget-user-username">Elizabeth Pierce</h3>
                                <h5 class="widget-user-desc">Web Designer</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">

                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="" alt="user image">
                                <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> Like</a>
                                <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                    <i class="fa fa-comments-o mr-1"></i> Comments (5)
                                </a>
                                </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->


                        </div>

                        <div class="tab-pane active show" id="settings">
                            <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label" >Name</label>

                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name" v-model="form.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" v-model="form.email">
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" v-on:change="updateProfile" name="photo" class="form-input">
                                    </div>

                                </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <button @click.prevent="updateInfo" type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
        mounted() {
            console.log('Component mounted.')
        },

        methods:  {
            updateInfo() 
            {
                this.form.put('api/profile/')
                .then(() => {

                })
                .catch(() => {

                });
            },

            updateProfile(e) 
            {
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) =>  {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },

        created() {
            axios.get("api/profile")
                .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
