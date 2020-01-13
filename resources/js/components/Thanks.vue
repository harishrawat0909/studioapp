<template>
    <div>
        <div class="card">
            <div class="card-title text-center">
                <p>Thank you for booking <b>{{ studioName }}</b></p>
                <button class="btn btn-link" @click.prevent="goBack"><i class="fa fa-arrow-left"></i> Back to Home</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['studioName'],

    methods: {
        goBack() {
            this.$emit('goBack')
        }
    }
}
</script>