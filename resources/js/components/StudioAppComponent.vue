<template>
    <div>
        <component 
            :is="activeComponent" 
            v-on:viewStudio="viewStudio" 
            v-on:goBack="goBack"
            v-on:userInfo="userInfo"
            v-on:thankyou="thankyou"
            :studioId="studioId"
            :slotNo="slotNo"
            :studioName="studioName"
        ></component>    
    </div>
</template>

<script>
import Studios from './StudiosComponent'
import Studio from './StudioComponent'
import UserInfo from './UserInfoComponent'
import Thanks from './Thanks'
export default {
    components : {
        Studios,
        Studio,
        UserInfo,
        Thanks
    },

    data() {
        return {
            activeComponent : 'Studios',
            studioId : 0,
            slotNo : [],
            studioName : ''
        }
    },

    methods : {
        viewStudio(studioId) {
            this.studioId = studioId
            this.activeComponent = 'Studio'
        },

        userInfo(data) {
            this.slotNo = data
            this.activeComponent = 'UserInfo'
        },

        goBack() {
            this.activeComponent = 'Studios'
        },

        thankyou(studioName) {
            this.studioName = studioName
            this.activeComponent = 'Thanks'
        }
    }
}
</script>