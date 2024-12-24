
import axiosAPI from '@/services/axiosAPI';
import { defineComponent } from '@vue/composition-api'
import { ref } from 'vue';

export default {
  setup() {
    
        const users = ref(null);
        const userProfiles = ref(null);
        
        const getUsers = async () => {
        const res = await axiosAPI.get('/api/get_users');
        users.value = res.data.users;
        return this.users;
        }
        console.log(getUsers);

        const getUserProfiles = async () => {
        const res = await axiosAPI.get('/api/get_user_profiles');
        userProfiles.value = res.data.user_profiles;
        return this.user_profiles;
        }
        console.log(getUserProfiles);



        return {
        getUsers,
        getUserProfiles
        }

  },

}