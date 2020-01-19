<template>
<div>
    <assignment-header></assignment-header>
    <assignment-section></assignment-section>
</div>
</template>

<script>
import AssignmentHeader from './AssignmentHeader'
import AssignmentSection from './AssignmentSection'
export default {
    components: {
        'assignment-header': AssignmentHeader,
        'assignment-section' :AssignmentSection
    }
}
</script>