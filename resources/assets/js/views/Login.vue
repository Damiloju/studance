<template>
    <div>
        <notifications group="login" animation-type="velocity" />
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="/" class="logo"><span>McPherson<span>University</span></span></a>
                <h5 class="text-muted mt-0 font-600">Students Attendance System</h5>
            </div>
            <div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold mb-0">Sign In</h4>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="" @submit.prevent="onSubmit()">

                        <div class="form-group">
                            <div class="col-xs-12">

                                <input class="form-control" :disabled="loading" type="text" required="" placeholder="Username" v-model="user.email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" :disabled="loading" type="password" required="" placeholder="Password" v-model="user.password">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input :disabled="loading" id="checkbox-signup" type="checkbox" v-model="user.remeberMe">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" :disabled="loading">
                                    <btn-loading v-if="loading"></btn-loading>
                                    <span v-else="">Login</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 mb-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->

            <!--<div class="row">-->
                <!--<div class="col-sm-12 text-center">-->
                    <!--<p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>-->
                <!--</div>-->
            <!--</div>-->

        </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        loading: false,
        user: {},
      }
    },
    methods: {
      onSubmit()
      {
        this.loading = true;
        axios.post('/login', this.user)
             .then(response => {
               if(response.data.status == 0 ){
                 this.$notify({
                   group:'login',
                   type:'success',
                   title:'Nice!',
                   text:'User has been logged in successfully'
                 });
                 window.location = '/backend/dashboard';
               }else{
                 this.$notify({
                   group:'login',
                   type:'error',
                   title:'Sorry!',
                   text:response.data.message,
                 });

               }
               this.loading = false;
             }).catch(error => {
                  this.$notify({
                    group:'login',
                    type:'error',
                    title:'Sorry!',
                    text:'We could not log you in! Please try again later'
                  });
                  this.loading = false;
                })
      }
    },
  }
</script>

<style scoped="">

</style>
