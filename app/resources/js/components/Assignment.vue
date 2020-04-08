<template>
    <div>
        <v-container justify="center">
            <v-breadcrumbs :items="navlist"></v-breadcrumbs>
        </v-container>
        <assignment-header :data="this.section_header"></assignment-header>
        <assignment-section
            @update-header="initialize($event)"
        ></assignment-section>
    </div>
</template>

<script>
import AssignmentHeader from "./AssignmentHeader";
import AssignmentSection from "./AssignmentSection";
export default {
    components: {
        "assignment-header": AssignmentHeader,
        "assignment-section": AssignmentSection
    },
    data() {
        return {
            id: parseInt(window.location.pathname.split("/").pop()),
            AuthStr: "Bearer " + localStorage.getItem("api"),
            section_header: null,
            navlist: [
                {
                    text: "Home",
                    disabled: false,
                    href: "/dashboard"
                },
                {
                    text: "All Assignments",
                    disabled: false,
                    href: "/assignments"
                },
                {
                    text: "Assignment",
                    disabled: true,
                    href: ""
                }
            ]
        };
    },
    created() {
        // this.initialize(e);
    },
    methods: {
        initialize(e) {
            this.section_header = e;
        }
    }
};
</script>
