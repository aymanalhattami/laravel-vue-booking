<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-2">
            <router-link class="navbar-brand" :to="{name: 'home'}">Home</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'example'}">Second</router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4">
            <router-view></router-view>
        </div>
    </div>
</template>