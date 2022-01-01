<template>
    <div class="card w-100">
        <div class="card-body">
            <router-link :to="{ name: 'bookable', params: { id: id } }">
                <h1 class="cart-title">{{ title }}</h1>
            </router-link>
            <p class="card-text">{{ description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        description: String,
        id: Number
    },
}
</script>