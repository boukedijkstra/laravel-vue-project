<template>
    <div class="container">

        <div id="loading" v-if="loading"><i class="float-right fas fa-spinner fa-spin text-orange"></i></div>

        <div class="block">
            <div class="block__header">
                <h1>Periodieke Taken</h1>
                <div class="block__header__buttons">
                    <a href="#" class="button"><i class="fas fa-sort"></i></a>
                    <a href="#" class="button" @click="fetchPeriodics()"><i class="fas fa-sync"></i></a>
                    <a href="#" class="button"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>

        <div id="overlay" v-if="showForm" @click="showForm=false"></div>

        <div class="block">
            <div v-if="periodics.length" class="job-history">
                <div class="job-history__inner" v-for="periodic in periodics">
                    <i class="fas fa-trash-alt float-right p-1 text-red" @click="deletePeriodic(periodic.id)"></i>
                    <p>{{ periodic.title }}</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {

        name: 'periodics',

        components: {
            Datepicker
        },

        data() {
            return {
                loading: true,
                showForm: false,
                timer: '',
                boats: [],
                users: [],
                periodic: {
                    id: '',
                    title: '',
                    description: '',
                    user: {}
                },
                periodics: [],
                pagination: {

                },
                edit: false,
            }

        },

        created() {
            this.fetchBoats();
            this.fetchUsers();
            this.fetchPeriodics();
            this.timer = setInterval(this.fetchJobs, 60000)
            this.loading = false;
        },

        methods: {
            fetchPeriodics() {
                this.loading = true;
                fetch('api/periodics')
                    .then(res => res.json())
                    .then(res => {
                        this.periodics = res.data;
                        this.loading = false;
                    })
                    .catch(err => console.log(err));
            },
            fetchBoats() {
                fetch('api/boats')
                    .then(res => res.json())
                    .then(res => {
                        this.boats = res.data;
                    })
            },
            fetchUsers() {
                fetch('api/users')
                    .then(res => res.json())
                    .then(res => {
                        this.users = res.data;
                    })
            },

        }

    }
</script>
