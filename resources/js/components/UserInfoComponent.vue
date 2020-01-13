<template>
    <div>
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" v-model.trim="firstName" placeholder="Enter your first name" class="form-control"><br>
                        <p v-if="error.firstNameError" style="color:red">{{ error.firstNameErrorMsg }}</p>
                        <input type="text" v-model.trim="lastName" placeholder="Enter your last name" class="form-control"><br>
                        <p v-if="error.lastNameError" style="color:red">{{ error.lastNameErrorMsg }}</p>
                        <input type="email" v-model.trim="email" placeholder="Enter you email address" class="form-control"><br>
                        <p v-if="error.emailError" style="color:red">{{ error.emailErrorMsg }}</p>
                        <button type="button" class="btn btn-success" @click="bookStudio">{{ saving ? 'Booking...' : 'Book' }}</button>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            You are about to book <b>{{ studioName }}</b> in <b>{{ location }}</b>
                            from {{ start_time === 12 ? start_time+'PM' : start_time > 12 ? start_time - 12+'PM' : start_time+'AM' }} 
                            to {{ end_time === 12 ? end_time+'PM' : end_time > 12 ? end_time - 12+'PM' : end_time+'AM' }}.
                        </p>
                        <button type="button" class="btn btn-warning" @click.prevent="viewStudio">
                            Choose a different time?
                        </button>
                        <button type="button" class="btn btn-primary" @click="goBack">
                            <i class="fa fa-arrow-left"></i> Go Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['slotNo'],
    
    data() {
        return {
            saving: false,
            firstName : '',
            lastName : '',
            email : '',
            emailPattern : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
            namePattern : /^[a-zA-Z]{1,20}$/,
            studioId : this.slotNo.studioId,
            studioName : this.slotNo.studioName,
            location : this.slotNo.location,
            start_time : this.slotNo.start_time,
            end_time : this.slotNo.end_time,
            error : {
                firstNameError : false,
                firstNameErrorMsg : '',
                lastNameError : false,
                lastNameErrorMsg : '',
                emailError : false,
                emailErrorMsg : '',
            }
        }
    },

    methods : {
        viewStudio() {
            this.$emit('viewStudio', this.studioId)
        },

        goBack() {
            this.$emit('goBack')
        },

        bookStudio() {
            this.saving = true
            this.error.firstNameError = false
            this.error.lastNameError = false
            this.error.emailError = false
            this.error.firstNameErrorMsg = ''
            this.error.lastNameErrorMsg = ''
            this.error.emailErrorMsg = ''
            if (this.firstName==='') {
                this.error.firstNameError = true
                this.error.firstNameErrorMsg = 'First name is required'
            }
            else if (!this.namePattern.test(this.firstName)) {
                this.error.firstNameError = true
                this.error.firstNameErrorMsg = 'First name must contain only aplhabets and can contain max 20 characters'
            }
            else if (this.lastName==='') {
                this.error.lastNameError = true
                this.error.lastNameErrorMsg = 'Last name is required'
            }
            else if (!this.namePattern.test(this.lastName)) {
                this.error.lastNameError = true
                this.error.lastNameErrorMsg = 'Last name must contain only aplhabets and can contain max 20 characters'
            }
            else if (this.email==='') {
                this.error.emailError = true
                this.error.emailErrorMsg = 'Email is required'
            }
            else if (!this.emailPattern.test(this.email)) {
                this.error.emailError = true
                this.error.emailErrorMsg = 'Email is invalid'
            }
            else {
                const userInfo = {
                    studio_id : this.studioId,
                    slot_id : this.slotNo.slotId,
                    email : this.email, 
                    first_name : this.firstName, 
                    last_name : this.lastName
                }
                axios.post('/book-studio', userInfo)
                .then(res => {
                    if (res.data.hasOwnProperty('message')) {
                        this.error.emailError = true
                        this.error.emailErrorMsg = res.data.message
                    } 
                    else {
                        this.$emit('thankyou', this.studioName)
                    }
                })
            }
            this.saving = false
            
        }
    }
}
</script>