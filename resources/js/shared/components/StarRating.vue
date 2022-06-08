<template>
    <div class="d-flex">
        <i class="fas fa-star" v-for="star in fullStar" :key="'full' + star" @click="$emit('input', star)"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="star in emptyStar" :key="'empty' + star" @click="$emit('input', fullStar + star)"></i>
    </div>
</template>
<script>
export default {
    props:{
        value: Number
    },
    computed:{
        halfStar(){
            const fraction = Math.round((this.value - Math.floor(this.value)) * 100);
            return fraction > 0 && fraction < 50;
        },
        fullStar(){
            // 4.5 = 5 stars / 4.3 = 4 and half
            return Math.round(this.value);
        },
        emptyStar(){
            //if rating would be 1.9, ceil(1.9) = 2, 5 - 2 = 3, render 3 empty stars
            return 5 - Math.ceil(this.value);
        }
    },
    created(){

    }
}
</script>
