<template>
<v-container   class="d-flex flex-row" >
    <dash-button></dash-button>
    <dash-button></dash-button>
    <dash-button></dash-button>
    <dash-button></dash-button>

</v-container>

</template>

<script>
import DashButton from './DashButton';
export default {
    components:{
        'dash-button' : DashButton
    }
}
</script>