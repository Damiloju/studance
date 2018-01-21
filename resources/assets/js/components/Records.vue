<template>
    <div class="wrapper">
        <notifications group="program" animation-type="velocity" />
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <!--<div class="btn-group pull-right m-t-20">-->
                        <!--<button @click.prevent="studentForm = !studentForm" class="btn btn-success btn-md waves-effect waves-light m-b-30"><i class="md md-add"></i>{{ text }}</button>-->
                    <!--</div>-->
                    <h4 class="page-title">All Events</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <transition
                    mode="out-in"
                    appear
                    enter-active-class="animated zoomIn"
            >
            <div>
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
                                    <td class="text-capitalize">{{event.event}}</td>
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
            events: events,
          }
        },
        computed:{
        },
        methods: {
        }
    }
</script>
