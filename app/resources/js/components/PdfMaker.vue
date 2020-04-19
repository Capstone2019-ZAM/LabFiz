<template>
    <div>
        <v-btn text small color="primary" @click="generate">Export PDF</v-btn>
    </div>
</template>

<script>
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;

export default {
    props: ["data"],
    data() {
        return {
            AuthStr: localStorage.getItem("api")
        };
    },
    mounted() {},
    methods: {
        generate() {
            var report = this.data;
            var user_name = " ";
            var docDefinition = {
                content: [
                    { text: report.title + "\n\n", style: "header" },
                    { text: "Lab: " + report.lab, style: "subheader" },
                    { text: "Status: " + report.status, style: "subheader" },
                    {
                        text: "Due Date: " + report.due_date,
                        style: "subheader"
                    },
                    {
                        text: "Assigned To: " + user_name + "\n\n",
                        style: "subheader"
                    }
                ],
                styles: {
                    header: {
                        fontSize: 16,
                        bold: true
                    },
                    subheader: {
                        fontSize: 14,
                        bold: true
                    },
                    quote: {
                        italics: true
                    },
                    small: {
                        fontSize: 8
                    }
                }
            };
            docDefinition.content = docDefinition.content.concat(
                this.generateSection(report.sections)
            );
            axios
                .get("/api/user/" + report.assigned_to, {
                    headers: { Authorization: "Bearer " + this.AuthStr }
                })
                .then(
                    response => {
                        debugger;
                        user_name =
                            response.data.data.first_name +
                            " " +
                            response.data.data.last_name;
                        docDefinition.content[4] = {
                            text: "Assigned To: " + user_name + "\n\n",
                            style: "subheader"
                        };
                        pdfMake
                            .createPdf(docDefinition)
                            .download(
                                "Inspection " +
                                    report.lab +
                                    " " +
                                    report.created_at +
                                    ".pdf"
                            );
                    },
                    error => {
                        user_name = "";
                        pdfMake
                            .createPdf(docDefinition)
                            .download(
                                "Inspection " +
                                    report.lab +
                                    " " +
                                    report.created_at +
                                    ".pdf"
                            );
                    }
                );
        },

        generateSection(secs) {
            var output = [];

            secs.forEach(element => {
                var secHead = new Object();
                secHead = { text: element.title, style: "subheader" };

                var sectable = {
                    style: "tableExample",
                    table: {
                        widths: [190, 60, 220],
                        body: [["Question", "Response", "Comments"]]
                    }
                };

                element.questions.forEach(q => {
                    var t_array = [];
                    let ans = "";
                    if (q.answer == 0) {
                        ans = "Yes";
                    } else if (q.answer == 1) {
                        ans = "No";
                    } else {
                        ans = "n/a";
                    }
                    t_array[0] = q.question;
                    t_array[1] = ans;
                    t_array[2] = q.description;
                    sectable.table.body.push(t_array);
                });
                output.push(secHead);
                output.push(sectable);
                output.push("\n\n");
            });
            return output;
        }
    }
};
</script>
