<template>
    <div class="wrapper">
        <notifications group="notify" animation-type="velocity" />

        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-20">
                        <button type="button" @click.prevent="changeButton" class="btn btn-custom waves-effect waves-light" aria-expanded="false">{{ text }} </button>
                    </div>
                    <h4 v-if="dashboard && step !== 3" class="page-title logo">Active Events
                    </h4>
                    <h4 v-if="form" class="page-title logo">Create Event</h4>
                    <h4 v-if="step === 3" class="page-title logo">Attendance</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

        <div v-show="dashboard && step !== 3">
            <div class="wrapper-page" v-show="events.length === 0">
                <div class="logo">
                    There are currently no active events (Create one above)
                </div>
            </div>
            <div v-show="events">
                <div class="row" v-for="(event, index ) in events" :key="index">
                    <!--<div class="col-md-3"></div>-->
                    <div class="col-md-6">
                        <div class="card border-primary m-b-20">
                            <div class="card-body text-primary">
                                <h5 class="card-title text-capitalize">{{ event.event }}</h5>
                                <p class="card-text text-capitalize">{{ event.session }}</p>
                                <p class="card-text text-capitalize">{{ event.semester }}</p>
                                <button :disabled="loading" style="cursor: pointer" @click.prevent="deleteEvent(event.id) " class="btn btn-primary">
                                    <btn-loading v-if="loading"></btn-loading>
                                    <span v-else="">Archive Event</span>
                                </button>
                                <button :disabled="loading" @click.prevent="attendance(event.id)" style="cursor: pointer" class="btn btn-primary">
                                    <btn-loading v-if="loading"></btn-loading>
                                    <span v-else="">Take Attendance</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-3"></div>-->
                </div>
            </div>
        </div>

            <div v-show="step === 3 && !form">
                <div class="row">
                    <div class="col-9">
                        <div class="card-box table-responsive">

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Identification Number</th>
                                    <th>level</th>
                                    <th>Active</th>
                                    <th>Time</th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr v-for="(student, index) in students" :key="index">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ student.student.name }}</td>
                                    <td>{{ student.student.program.department.name }}</td>
                                    <td>{{ student.student.matric_number || student.student.temp_number}}</td>
                                    <td>{{ student.student.level }}</td>
                                    <td>{{student.student.deleted_at === null ? 'Yes':'No' }}</td>
                                    <td>{{ student.student.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-3 text-center">
                        <div class="form-group">
                            <input type="text" style="color:white;" @keyup.enter="attendEvent" v-model="matric_number" class="form-control" :autofocus="autofocus">
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>

            <div v-show="form">
                <div class="row" >
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <form role="form" @submit.prevent="addEvent">
                                <div class="form-group">
                                    <label>Event Type</label>
                                    <div>
                                        <select class="form-control" :disabled="loading" required  v-model="event.event">
                                            <option  value="chapel">Chapel</option>
                                            <option  value="exam">Exam</option>
                                            <option  value="classroom">Classroom</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="position">Session</label>
                                    <input type="text" :disabled="loading" class="form-control" v-model="event.session" id="position" placeholder="Enter Session e.g 2017/2018" required>
                                </div>

                                <div class="form-group">
                                    <label>Semester</label>
                                    <div>
                                        <select class="form-control" :disabled="loading" required v-model="event.semester">
                                            <option  value="first">First</option>
                                            <option  value="second">Second</option>
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




        </div> <!-- end container -->

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
          return {
            step: 1,
            form: false,
            loading: false,
            event:{},
            events: events,
            currentEvent: 0,
            dashboard: true,
            autofocus: true,
            matric_number: null,
            students:{},
          }
        },
        computed:{
            text(){
              return this.form ? 'DashBoard' : 'New Event';
            }
        },
        methods: {
          changeButton(){
            this.form = !this.form;
            this.dashboard = !this.dashboard;
            this.step = 1;
          },
          addEvent() {
            this.loading = true;
            axios.post('/backend/event/create', this.event)
                .then(response => {
                  if(response.data.status == 0 ){
                    this.$notify({
                      group:'notify',
                      type:'success',
                      title:'Nice!',
                      text:response.data.message,
                    });
                    this.events = response.data.data;
                  }else{
                    this.$notify({
                      group:'notify',
                      type:'warning',
                      title:'Sorry!',
                      text:response.data.message,
                    });
                  }
                  this.loading = false;
                  this.form = false;
                  this.dashboard = true
                }).catch(error => {
                  this.$notify({
                    group:'notify',
                    type:'warning',
                    title:'Sorry!',
                    text:'We could not create that event! Please try again later'
                  });
              this.loading = false;
              this.form = false;
              this.dashboard = true
            })
          },
          deleteEvent(index) {
            let number;
            number = index;
            let url = '/backend/event/delete/' + number ;
            this.loading = true;
            axios.post(url)
                .then(response => {
                  if(response.data.status == 0 ){
                    this.$notify({
                      group:'notify',
                      type:'success',
                      title:'Nice!',
                      text:response.data.message,
                    });
                    this.events = response.data.data;
                  }else{
                    this.$notify({
                      group:'notify',
                      type:'warning',
                      title:'Sorry!',
                      text:response.data.message,
                    });

                  }
                  this.loading = false;
                }).catch(error => {
              this.$notify({
                group:'notify',
                type:'warning',
                title:'Sorry!',
                text:'We could not delete that event! Please try again later'
              });
              this.loading = false;
            })
          },
          attendance(event){
            this.currentEvent = event;
            let url = '/backend/event/' + this.currentEvent;
            axios.get(url)
                .then(response => {
                  if(response.data.status == 0 ){
                    this.$notify({
                      group:'notify',
                      type:'success',
                      title:'Nice!',
                      text:response.data.message,
                    });
                    this.students = response.data.data;
                  }else{
                    this.$notify({
                      group:'notify',
                      type:'warning',
                      title:'Sorry!',
                      text:response.data.message,
                    });
                  }
                  this.loading = false;
                  this.form = false;
                  this.dashboard = true
                }).catch(error => {
              this.$notify({
                group:'notify',
                type:'warning',
                title:'Sorry!',
                text:'We could not get event! Please try again later'
              });
              this.loading = false;
              this.form = false;
              this.dashboard = true
            });
            this.step = 3
          },
          attendEvent(){
            let data = {
              'matric_number': this.matric_number,
              'event': this.currentEvent,
            };
            axios.post('/backend/records/add', data)
                .then(response => {
                  if(response.data.status == 0 ){
                    this.$notify({
                      group:'notify',
                      type:'success',
                      title:'Nice!',
                      text:response.data.message,
                    });
                    this.students = response.data.data;
                    this.matric_number = null
                  }else{
                    this.$notify({
                      group:'notify',
                      type:'warning',
                      title:'Sorry!',
                      text:response.data.message,
                    });
                    this.matric_number = null
                  }
                }).catch(error => {
                  this.$notify({
                    group:'notify',
                    type:'warning',
                    title:'Sorry!',
                    text:'We could not add that student to the list! Please try again later'
                  });
              this.matric_number = null
            })
          }
        }
    }
</script>