<template>
    <div>
        <div class="form-row">
            <div class="col">
                <input 
                    type="text" v-model.trim="query" 
                    @keyup="getStudios('search', 'desc')" 
                    placeholder="Search studio" class="form-control"
                >
            </div>
            <div class="col">
                <select @change="filter" class="form-control">
                    <option value="desc">Newer First</option>
                    <option value="asc">Older First</option>
                    <option value="des">Higher Price First</option>
                    <option value="as">Lower Price First</option>
                    <option value="10">Available from 10AM to 11AM</option>
                    <option value="12">Available from 12PM to 1PM</option>
                    <option value="14">Available from 2PM to 3PM</option>
                    <option value="16">Available from 4PM to 5PM</option>
                    <option value="18">Available from 6PM to 7PM</option>
                </select>
            </div>
        </div>
        <div  v-for="studio in studios" :key="studio.id" class="text-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ studio.name }}</h3>
                    <p>Opens at: {{ studio.opens_at }}AM and Closes at: {{ studio.closes_at - 12 }}PM</p>
                    <p><b>Location: {{ studio.location }}</b></p>
                    <button type="button" @click.prevent="viewMore" :id="studio.id" class="btn btn-secondary">View More</button>
                </div>
            </div>
            <br>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            studios : [],
            type : 'get',
            condition : 'desc',
            query : ''
        }
    },

    mounted() {
        this.getStudios(this.type, this.condition)
    },

    methods: {
        async getStudios(type, condition) {
            const studios = await axios.get(`/${type}-studios/${condition}/${this.query}`)
            this.studios = studios.data
        },

        filter(event) {
            this.getStudios('get', event.target.value)
        },

        viewMore(event) {
            this.$emit('viewStudio', event.target.id)
        },
    }
}
</script>

<style>
.booked{
    color: red;
    font-weight: bold
}
.available{
    color: green;
    font-weight: bold
}
.error {
    color: red;
    font-weight: 300
}
</style>