<template>
    <div id="app">
        <v-form>
            <v-card class="mx-auto" max-width="750" outlined >
            <v-card-title class="justify-center" >
                <span class="headline" >Issue Tracker Form</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container>
                <v-row>
                    <v-col class="d-flex" cols="12" sm="8" md="8">
                    <v-text-field v-model="Title" label="Title" :rules="titleRules" clearable></v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6" md="4">
                    <v-select :items="status" label="Status"></v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="d-flex" cols="12" sm="6" md="3">
                    <v-select :items="lab" label="Lab#"></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6" md="5">
                    <v-select :items="assign" label="Assigned To"></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6" md="3">
                    <v-select :items="severity" label="Severity"></v-select>
                    </v-col>
                </v-row>    
                <v-col cols="12" md="fill">
                    <v-textarea solo name="input-15-4" :counter="150" label="Description" clearable></v-textarea>
                 </v-col>
                 <v-col cols="12" md="fill">
                    <v-textarea solo name="input-15-4" :counter="100" label="Comments" clearable></v-textarea>
                 </v-col>
                 <v-row align="center" justify="center">
                    <v-btn color="primary">
                        <v-icon>mdi-mouse</v-icon>Post
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
        titleRules: [
            v=> !!v || "Title is required"

        ],
        status:['Status1','Status2','Status3','Status4'],
        lab:['Lab1','Lab2','Lab3','Lab4'],
        assign:['Test1','Test2','Test3','Test4'],
        severity:['1','2','3','4'],
    })
};
</script>
