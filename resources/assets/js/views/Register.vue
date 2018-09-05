<template>
    <div>
        <notifications group="program" animation-type="velocity" />
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <transition-group
                mode="out-in"
                appear
                enter-active-class="animated slideInDown"
        >
        <div :key="1" class="wrapper-page">
            <div class="text-center">
                <a href="/" class="logo"><span>McPherson<span>University</span></span></a>
                <h5 class="text-muted mt-0 font-600">Students Registration System</h5>
            </div>
            <!-- end card-box-->

            <!--<div class="row">-->
                <!--<div class="col-sm-12 text-center">-->
                    <!--<p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>-->
                <!--</div>-->
            <!--</div>-->

        </div>

        <div :key="2" class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card-box">
                    <div class="text-center">
                        <h4 class="text-uppercase font-bold mb-0">Register</h4>
                    </div>
                    <div class="p-20">
                        <form class="form-horizontal m-t-20" @submit.prevent="register">

                            <div class="form-group row">
                                <label for="name" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input id="name" class="form-control" :disabled="loading" type="text" required v-model="student.name" placeholder="Enter your full name ( SURNAME FIRST )">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-2 col-form-label">Level</label>
                                <div class="col-10">
                                    <select id="level" class="form-control" :disabled="loading" v-model="student.level" required placeholder="level">
                                        <option value="selected" disabled selected>Select your level</option>
                                        <option  value="100">100</option>
                                        <option  value="200">200</option>
                                        <option  value="300">300</option>
                                        <option  value="400">400</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="m_number" class="col-2 col-form-label">Matric Number</label>
                                <div class="col-10">
                                    <input class="form-control" id="m_number" :disabled="loading" type="text" required v-model="student.matric_number" placeholder="Enter your matric number">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="files" class="col-2 col-form-label">Passport Photo</label>
                                <div class="col-10">
                                    <input type="file" id="files" @change="uploadImage" :disabled="loading" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="program" class="col-2 col-form-label">Program</label>
                                <div class="col-10">
                                    <select id="program" class="form-control" :disabled="loading" v-model="student.program_id" required>
                                        <option v-for="(program ,index) in this.programs" :value="index + 1" >{{ program.name}}</option>
                                        <option value="selected" disabled selected>Select your program</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-center m-t-40 mb-0">
                                <div class="col-xs-12">
                                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                                        <btn-loading v-if="loading"></btn-loading>
                                        <span v-else="">Register</span>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>



        <div :key="3" class="row">
            <div class="col-sm-12 text-center">
                <p class="text-muted"><a href="/admin" class="text-muted m-l-5"><b>Admin</b></a></p>
            </div>
        </div>

        </transition-group>

    </div>
</template>

<script>
  export default {
    mounted() {
      console.log('Component mounted.');
      axios.get('/backend/programs')
          .then(response => {
            if(response.data.status == 0 ){
              this.$notify({
                group:'program',
                type:'success',
                title:'Nice!',
                text:response.data.message,
              });
              this.programs = response.data.data
            }else{
              this.$notify({
                group:'program',
                type:'error',
                title:'Sorry!',
                text:response.data.message,
              });

            }
            this.loading = false;
          }).catch(error => {
        this.$notify({
          group:'program',
          type:'error',
          title:'Sorry!',
          text:'We could not get the Programs! Please try again later'
        });
        this.loading = false;
      })
    },
    data () {
      return {
        loading: false,
        programs: {},
        student: {
          program_id: 'selected',
          level: 'selected',
        }
      }
    },
    methods: {
      uploadImage(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);
      },
      createImage(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.student.photo = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      register()
      {
        this.loading = true;
        axios.post('/students', this.student)
            .then(response => {
              if(response.data.status == 0 ){
                this.$notify({
                  group:'program',
                  type:'success',
                  title:'Nice!',
                  text:response.data.message,
                });
                this.students = response.data.data;
                this.student = {}
              }else{
                this.$notify({
                  group:'program',
                  type:'warning',
                  title:'Sorry!',
                  text:response.data.message,
                });

              }
              this.loading = false;
            }).catch(error => {
          this.$notify({
            group:'program',
            type:'warning',
            title:'Sorry!',
            text:'We could not register that student! Please try again later'
          });
          this.loading = false;
        })
      }
    },
  }
</script>

<style scoped="">

</style>
