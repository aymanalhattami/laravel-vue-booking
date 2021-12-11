<template>
    <div class="card">
        <div class="card-body">
            <h1 class="cart-title">{{ itemTitle }}</h1>
            <p class="card-text">{{ itemContent }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        itemTitle: String,
        itemContent: String,
        price: Number
    },
}
</script>