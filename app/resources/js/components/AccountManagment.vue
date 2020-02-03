<template>
    <div id="app">
        <v-form>
            <v-card class="mx-auto" max-width="600" outlined >
            <v-card-title class="justify-center" >
                <span class="headline" >Account Management</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container>
                <v-row>
                    <v-col class="d-flex" cols="12" sm="8" md="6">
                    <v-text-field v-model="firstname" label="First Name" :counter="10" :rules="NameRules" clearable outlined></v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="8" md="6">
                    <v-text-field v-model="lastname" label="Last Name" :counter="10" :rules="NameRules" clearable outlined></v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col class="d-flex" cols="12" sm="6" md="5">
                    <v-select :items="items" label="Role" outlined></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6" md="5">
                    <v-select :items="items" label="Department" outlined></v-select>
                    </v-col>
                </v-row>    
                <v-col cols="12" md="fill">
                    <v-text-field v-model="email" label="Email" :rules="emailRules" clearable outlined></v-text-field>
                 </v-col>
                 <v-row align="center" justify="center">
                    <v-btn color="primary">
                        <v-icon>mdi-account-circle</v-icon>Create Account
                    </v-btn>
                </v-row>
                </v-container>
            </v-card-text>
            </v-card>
        </v-form>
    </div>
</template>
<script>
export default {
    data: ()=>({
        valid:false,
        firstname:'',
        lastname: '',
        NameRules: [
            v=> !!v || "Name is Required",
            v => v.length <= 10 || 'Name must be less than 10 characters',
        ],
        email:'',
        emailRules:[
             v => !!v || 'E-mail is required',
            v => /.+@.+/.test(v) || 'E-mail must be valid',
        ],
        items:['Test1','Test2','Test3','Test4'],
        
    })
};
</script>