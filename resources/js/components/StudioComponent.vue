<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ studio.name }}</h3>
                <p>About {{ studio.name }}: <br>{{ studio.description }}</p>
                <p>Opens at: {{ studio.opens_at }}AM and Closes at: {{ studio.closes_at - 12 }}PM</p>
                <p><b>Location: {{ studio.location }}</b></p>
                <p><b>Price: Rs.{{ studio.price }}</b></p>
                <div v-for="slots in studio.studiosslots" :key="slots.id">
                    <input type="radio" :id="slots.id" :value="slots.id" v-model.trim="slot.slotId" :disabled="slots.is_booked=='1'"> 
                    <span v-if="slots.start_time > 12">{{ slots.start_time - 12 }}</span><span v-else>{{ slots.start_time }}</span><span v-if="slots.start_time===10">AM</span><span v-else>PM</span> 
                    <span>to</span> 
                    <span v-if="slots.end_time > 12">{{ slots.end_time - 12 }}</span><span v-else>{{ slots.end_time }}</span><span v-if="slots.end_time===11">AM</span><span v-else>PM</span>
                    <span v-if="slots.is_booked=='1'" class="booked">Already Booked</span> <span v-else class="available">Available</span>
                </div><br>
                <button type="button" class="btn btn-success" @click.prevent="bookStudio">
                {{ saving ? 'Please wait...' : 'Book Now' }}
                </button><br>
                <p v-if="error" class="error">{{ errorMsg }}</p>
            </div>
        </div>
        <button class="btn btn-link" @click.prevent="goBack"><i class="fa fa-arrow-left"></i> Go Back</button>
    </div>
</template>

<script>
export default {
    props : ['studioId'],

    data() {
        return {
            studio : [],
            errorMsg : '',
            error : false,
            saving : false,
            slot : {
                studioId : 0,
                studioName: '',
                location : '',
                slotId : 0,
                start_time : 0,
                end_time : 0
            }
        }
    },

    mounted() {
        this.getStudio(this.studioId)
    },

    methods : {
        async getStudio(studioId) {
            const studio = await axios.get(`/get-studio/${studioId}`)
            this.studio = studio.data
        },

        async bookStudio() {
            if (this.slot.slotId===0) {
                this.errorMsg = 'Please choose a time.'
                this.error = true               
            }
            else {
                this.saving = true
                this.errorMsg = ''
                this.error = false
                const availability = await axios.get(`/check-studio-availability/${this.slot.slotId}`)
                if (availability) {
                    const slot = this.studio.studiosslots.filter(ss => ss.id===this.slot.slotId)
                    this.slot.studioId = this.studio.id
                    this.slot.studioName = this.studio.name
                    this.slot.location = this.studio.location
                    this.slot.start_time = slot[0].start_time
                    this.slot.end_time = slot[0].end_time
                    this.$emit('userInfo', this.slot)
                } 
                else {
                    this.saving = false
                    this.errorMsg = 'Someone has recently booked this studio.'
                    this.error = true
                }
            }
        },

        goBack() {
            this.$emit('goBack')
        }
    }
}
</script>