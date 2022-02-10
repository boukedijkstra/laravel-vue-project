<template>
    <div class="container">

        <div id="loading" v-if="loading"><i class="float-right fas fa-spinner fa-spin text-orange"></i></div>

        <div class="block">
            <h1 class="mb-2">Boten</h1>

            <div class="pb-5">
                <select name="boats" id="boats" class="form-control" @change="fetchBoatDetails()" v-model="boat">
                    <option value="" class="form-control">Selecteer Boot...</option>
                    <option v-for="boat in boats" v-bind:key="boat.id" v-bind:value="boat.id">{{ boat.name }} - {{ boat.type }}</option>
                </select>

<!--                <div class="block bg-red text-white" v-if="boat">Verhuurd t/m vandaag 18:00 door Jansen</div>-->
<!--                <div class="block bg-yellow" v-if="boat">Ingeleverd maar nog niet klaar voor verhuur</div>-->
                <div class="block bg-green text-white mb-0" v-if="boat">Klaar voor verhuur</div>
            </div>
        </div>

        <div class="block" v-if="boat">
            <h2 class="mb-2">Reparatie Historie</h2>

            <div v-if="jobs.length" class="job-history">
                <div class="job-history__inner" v-for="job in jobs">
                    <i class="fas fa-trash-alt float-right p-1 text-red" @click="deleteJob(job.id)"></i>
                    <p>{{ job.description }}</p>
                    <span class="text-small">{{ job.user.name }} - {{ job.created_at }}</span>
                    <p class="text-green">{{ job.completed_note }} <span v-if="!job.completed_note">Opgelost</span></p>
                    <span class="text-small" v-if="job.completed_by">{{ job.completed_by.name }} - {{ job.completed_at }}</span>
                </div>
            </div>

            <p v-if="!jobs.length" class="pb-3">Nog geen reparaties opgeslagen</p>

        </div>

        <div class="block" v-if="boat">
            <h2 class="mb-2">Periodieke Taken</h2>
            <p class="pb-3">Nog geen periodieke taken opgeslagen</p>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                boats: [],
                boat: '',
                jobs: [],
            }

        },

        created() {

            this.fetchBoats();

        },

        methods: {

            fetchBoats() {
                fetch('api/boats')
                    .then(res => res.json())
                    .then(res => {
                        this.boats = res.data;
                        this.loading = false;
                    });
            },

            fetchBoatDetails() {
                this.loading = true;
                fetch(`api/boats/${this.boat}/jobs`)
                    .then(res => res.json())
                    .then(res => {
                        this.jobs = res.data;
                        this.loading = false;
                    });
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
                        this.fetchBoatDetails();
                    })
                    .catch(err => console.log(err))
            }
        }

    }
</script>
