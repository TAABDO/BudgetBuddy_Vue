<template>
    <div>
        <h1>Register</h1>

        <form @submit.prevent="register">
            <input type="text" v-model="name" placeholder="Username" />
            <input type="email" v-model="email" placeholder="Email" />
            <input type="password" v-model="password" placeholder="Password" />
            <button type="submit">Register</button>
        </form>
    </div>
</template>
<script>

import axios from 'axios';
export default {
    data(){
        return{
            name:'',
            email:'',
            password:'',
        }
    },

methods :{
    register()  {
        axios.post('http://localhost:8000/api/register',{
            name:this.name,
            email:this.email,
            password:this.password
        })
        .then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        })
    }
}

}
</script>
