<template>
    <div class="container">

        <div id="loading" v-if="loading"><i class="float-right fas fa-spinner fa-spin text-orange"></i></div>

        <div class="block">
            <div class="block__header">
                <h1>Klussen</h1>
                <div class="block__header__buttons">
                    <a href="#" class="button"><i class="fas fa-sort"></i></a>
                    <a href="#" class="button" @click="fetchJobs()"><i class="fas fa-sync"></i></a>
                    <a href="#" class="button" @click="newJob()"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>

        <div id="overlay" v-if="showForm" @click="showForm=false"></div>

        <div class="block overlay" v-if="showForm">
            <form @submit.prevent="addJob">
                <select name="boat_id" v-model="job.boat_id" required>
                    <option value="">Boot...</option>
                    <option v-for="boat in boats" v-bind:key="'b'+boat.id" :value="boat.id" :selected="job.boat.id === boat.id">{{ boat.name }} - {{ boat.type }}</option>
                </select>
                <textarea name="description" rows="3" v-model="job.description" placeholder="Omschrijving probleem..." style="resize: none;" required></textarea>
                <textarea name="completed_note" rows="3" v-model="job.completed_note" v-if="edit" placeholder="Hoe opgelost?" style="resize: none;" class="border-green"></textarea>
<!--                <select name="assigned_user_id" v-model="job.assigned_user_id">-->
<!--                    <option value="">Medewerker... (optioneel)</option>-->
<!--                    <option v-for="user in users" v-bind:key="'a'+user.id" :value="user.id" :selected="job.assigned_user_id === user.id">{{ user.name }}</option>-->
<!--                </select>-->
<!--                <datepicker placeholder="Oplossen voor:"></datepicker>-->
                <i class="fas fa-exclamation text-orange pl-1"></i>
                <input type="checkbox" name="priority" id="priority" v-model="job.priority"> <label for="priority">Prioriteit?</label>
                <button type="submit" class="button button--large button--black button--margin"><i class="fas fa-save"></i><span v-if="edit">Aanpassen</span><span v-if="!edit">Opslaan</span></button>
                <a class="button button--large button--red button--margin" v-if="edit" @click="deleteJob(job.id)"><i class="fas fa-trash-alt"></i> Verwijderen</a>
                <a class="button button--large button--green button--margin" v-if="edit" @click="completeJob(job)"><i class="fas fa-check"></i> Oplossen</a>
<!--                <a class="button button&#45;&#45;large button&#45;&#45;black button&#45;&#45;margin" @click="showForm=false"><i class="fas fa-times"></i> Annuleren</a>-->
            </form>
        </div>

        <div class="block block--job" v-for="job in jobs" v-bind:key="job.id" @click="editJob(job)">
            <span class="block__boat-type">{{ job.boat.boat_type.code }}</span>
            <h2 class="d-inline-block" v-if="job.boat">{{ job.boat.name }}</h2><br/>
            <i class="fas fa-exclamation text-orange priority float-left" v-if="job.priority"></i>
            <i class="priority float-left" v-if="!job.priority">&nbsp;&nbsp;</i>
            <p class="d-inline-block">{{ job.description }}</p>
            <span class="block__footer">{{ job.user.name }} - {{ job.created_at }}</span>
        </div>

    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {

        name: 'jobs',

        components: {
            Datepicker
        },

        data() {
            return {
                loading: true,
                showForm: false,
                timer: '',
                jobs: [],
                boats: [],
                users: [],
                job: {
                    id: '',
                    description: '',
                    completed_note: '',
                    user: {},
                    assigned_user: {},
                    assigned_user_id: '',
                    boat: {},
                    boat_id: '',
                    priority: true
                },
                pagination: {

                },
                edit: false,
            }

        },

        created() {
            this.fetchBoats();
            this.fetchUsers();
            this.fetchJobs();
            this.timer = setInterval(this.fetchJobs, 60000)
        },

        methods: {
            fetchJobs(page_url) {
                this.loading = true;
                page_url = page_url || 'api/jobs';
                let vm = this;
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.jobs = res.data;
                        // vm.makePagination(res.meta, res.links);
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
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            },
            deleteJob(id) {

                this.loading = true;
                fetch(`api/jobs/${id}`, {
                    method: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(res => res.json())
                    .then(data => {
                        this.fetchJobs();
                        this.showForm = false;
                    })
                    .catch(err => console.log(err))

            },
            newJob() {
              this.clearJob();
              this.showForm = true;
            },
            clearJob() {
                this.job.id = '';
                this.job.description = '';
                this.job.completed_note = '';
                this.job.user = {};
                this.job.boat = {};
                this.job.boat_id = '';
                this.job.assigned_user = {};
                this.job.assigned_user_id = '';
                this.job.priority = true;
                this.edit = false;
            },
            addJob() {
                this.loading = true;
                if (this.edit === false) {
                    fetch('api/jobs', {
                        method: 'post',
                        body: JSON.stringify(this.job),
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.showForm = false;
                            this.clearJob();
                            this.fetchJobs();
                        })
                        .catch(err => console.log(err))
                } else {
                    fetch(`api/jobs/${this.job.id}`, {
                        method: 'put',
                        body: JSON.stringify(this.job),
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.showForm = false;
                            this.clearJob();
                            this.fetchJobs();
                        })
                        .catch(err => console.log(err))
                }
            },
            editJob(job) {
                this.edit = true;
                this.showForm = true;
                this.job.id = job.id;
                this.job.description = job.description;
                this.job.completed_note = job.completed_note;
                this.job.boat = job.boat;
                this.job.priority = job.priority;
                this.job.boat_id = job.boat.id;
                this.job.assigned_user = job.assigned_user;
                this.job.assigned_user_id = job.assigned_user_id;
            },
            completeJob(job) {

                fetch(`api/jobs/complete/${job.id}`, {
                    method: 'put',
                    body: JSON.stringify(this.job),
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        this.fetchJobs();
                        this.showForm = false;
                    })
                    .catch(err => console.log(err))

            }
        }

    }
</script>
