<template>
    <div class="wrapper">
        <notifications group="notify" animation-type="velocity" />
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-20">
                        <button v-if="step !== 1" @click.prevent="step = 1" class="btn btn-success btn-md waves-effect waves-light m-b-30"><i class="md md-add"></i>Events</button>
                    </div>
                    <h4 class="page-title">All Events</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <transition
                    mode="out-in"
                    appear
                    enter-active-class="animated zoomIn"
            >
            <div :key="1">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Event</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>Active</th>
                                    <th>Date Created</th>
                                </tr>
                                </thead>


                                <tbody class="text-center">
                                <tr v-for="(event,index) in events" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td class="text-capitalize"><a :href="event.id" @click.prevent="record(event.id)">{{event.event}}</a></td>
                                    <td>{{event.session }}</td>
                                    <td class="text-capitalize">{{event.semester }}</td>
                                    <td>{{event.deleted_at === null ? 'Yes':'No'}}</td>
                                    <td>{{event.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
            </transition>

            <!--<transition-->
                    <!--mode="out-in"-->
                    <!--appear-->
                    <!--enter-active-class="animated slideInRight"-->
            <!--&gt;-->
                <!--<div :key="2" v-show="step === 2">-->
                    <!--<div class="row">-->
                        <!--<div class="col-12">-->
                            <!--<div class="card-box table-responsive">-->

                                <!--<table id="datatable" class="table table-bordered">-->
                                    <!--<thead>-->
                                    <!--<tr>-->
                                        <!--<th>S/N</th>-->
                                        <!--<th>Name</th>-->
                                        <!--<th>Department</th>-->
                                        <!--<th>Identification Number</th>-->
                                        <!--<th>level</th>-->
                                        <!--<th>Active</th>-->
                                        <!--<th>Time</th>-->
                                    <!--</tr>-->
                                    <!--</thead>-->


                                    <!--<tbody>-->
                                    <!--<tr v-for="(student, index) in students" :key="index">-->
                                        <!--<td>{{ index + 1}}</td>-->
                                        <!--<td>{{ student.student.name }}</td>-->
                                        <!--<td>{{ student.student.program.department.name }}</td>-->
                                        <!--<td>{{ student.student.matric_number || student.student.temp_number}}</td>-->
                                        <!--<td>{{ student.student.level }}</td>-->
                                        <!--<td>{{student.student.deleted_at === null ? 'Yes':'No' }}</td>-->
                                        <!--<td>{{ student.student.created_at }}</td>-->
                                    <!--</tr>-->
                                    <!--</tbody>-->
                                <!--</table>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div> &lt;!&ndash; end row &ndash;&gt;-->
                <!--</div>-->
            <!--</transition>-->

        </div> <!-- end container -->

    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data() {
          return {
            loading: false,
            step:1,
            events: events,
            students:{}
          }
        },
        computed:{
        },
        methods: {
          record(event){
            this.currentEvent = event;
            let url = '/backend/records/view?event=' + this.currentEvent;

            window.location.href = url;

          }
        }
    }
</script>
