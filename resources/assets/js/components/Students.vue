<template>
    <div class="wrapper">
        <notifications group="program" animation-type="velocity" />
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-20">
                        <button @click.prevent="studentForm = !studentForm" class="btn btn-success btn-md waves-effect waves-light m-b-30"><i class="md md-add"></i>{{ text }}</button>
                    </div>
                    <h4 class="page-title">Students</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <transition
                    mode="out-in"
                    appear
                    enter-active-class="animated zoomIn"
            >
            <div v-show="studentForm === false">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <a href="/backend/students/barcode"><button class="btn btn-success btn-md waves-effect waves-light m-b-30">Generate Barcode</button></a>
                            <a href="/backend/students/pdf"><button class="btn btn-success btn-md waves-effect waves-light m-b-30 pull-right">Generate PDF</button></a>
                            <table id="datatable-buttons" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Matric Number</th>
                                    <th>level</th>
                                    <th>Barcode</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">
                                <tr v-for="(student,index) in students" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{student.name}}</td>
                                    <td>{{student.program === null ? '-':student.program.department.name }}</td>
                                    <td>{{student.matric_number === null ? '-':student.matric_number }}</td>
                                    <td>{{student.level}}</td>
                                    <td><img :src="'/barcodes/'+student.matric_number+'.png'" alt="No Barcode Yet" /></td>
                                    <!--<td>{{student.temp_number === null ? '-':student.temp_number}}</td>-->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
            </transition>

            <transition
                    mode="out-in"
                    appear
                    enter-active-class="animated pulse"
            >
            <div v-show="studentForm === true">
                <div class="row" >
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <form role="form" @submit.prevent="addStudent">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" :disabled="loading" required v-model="student.name" class="form-control" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <div>
                                        <select class="form-control" :disabled="loading" required v-model="student.level">
                                            <option  value="100">100</option>
                                            <option  value="200">200</option>
                                            <option  value="300">300</option>
                                            <option  value="400">400</option>
                                            <option  value="500">500</option>
                                            <option  value="600">600</option>
                                            <option  value="700">700</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" v-if="student.level == 100">
                                    <label for="position">Tempory ID</label>
                                    <input type="text" :disabled="loading" class="form-control" v-model="student.temp_number" id="position" placeholder="Enter Temporary ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Matric Number</label>
                                    <input type="text" :disabled="loading" class="form-control" v-model="student.matric_number" id="exampleInputEmail1" placeholder="Enter Matric Number">
                                </div>

                                <div class="form-group">
                                    <label for="files">Passport Photo</label>
                                    <div>
                                        <input type="file" id="files" @change="uploadImage" :disabled="loading" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Program</label>
                                    <div>
                                        <select class="form-control" :disabled="loading" v-model="student.program_id" required>
                                            <option v-for="(program ,index) in this.programs" :value="index + 1" >{{ program.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" :disabled="loading" class="btn btn-success waves-effect waves-light pull-right">
                                    <btn-loading v-if="loading"></btn-loading>
                                    <span v-else="">Submit</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </transition>

        </div> <!-- end container -->

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
        data() {
          return {
            student: {},
            loading: false,
            programs: {},
            studentForm: false,
            students: students,
          }
        },
        computed:{
          text(){
            return this.studentForm ? 'View Students' : 'Add Student';
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
          addStudent() {
            this.loading = true;
            axios.post('/backend/students', this.student)
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
        }
    }
</script>
