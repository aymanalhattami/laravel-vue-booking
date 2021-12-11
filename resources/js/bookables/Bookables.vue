<template>
    <div>
        <div v-if="loading">Data is Loading</div>
        <div v-else>
            <div class="row mb-3" v-for="row in rows" :key="'row' + row">
                <div class="col" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <bookable-list-item
                        :item-title="bookable.title" 
                        :item-content="bookable.content"
                        :price="1000"></bookable-list-item>  
                </div>

                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
            </div>
        </div>
    </div>
</template>

<script>
import BookableListItem from './BookableListItem';
export default {
    components: {
        BookableListItem: BookableListItem
    },
    data(){
        return {
            bookables: null,
            loading: false,
            columns: 3
        }
    },
    computed:{
        rows(){
            return this.bookables === null 
                ? 0 
                : Math.ceil(this.bookables.length / this.columns);
        }
    },
    methods:{
        bookablesInRow(row){
            return this.bookables.slice((row - 1) * this.columns, row * this.columns)
        },

        placeholdersInRow(row){
            return this.columns - this.bookablesInRow(row).length
        }
    },
    created(){
        this.loading = true;

        this.bookables = [
            {
                id: 1,
                title: "Cheap Villa !!!",
                content: "A very Cheap Villa"
            },
            {
                id: 2,
                title: "Cheap Villa !!!!!!",
                content: "A very Cheap Villa !!!!!!"
            },
            {
                id: 3,
                title: "Cheap Villa !!!",
                content: "A very Cheap Villa"
            },
            {
                id: 4,
                title: "Cheap Villa !!!!!!",
                content: "A very Cheap Villa !!!!!!"
            },
            {
                id: 5,
                title: "Cheap Villa !!!",
                content: "A very Cheap Villa"
            },
            {
                id: 6,
                title: "Cheap Villa !!!!!!",
                content: "A very Cheap Villa !!!!!!"
            },
            {
                id: 7,
                title: "Cheap Villa !!!",
                content: "A very Cheap Villa"
            },
            {
                id: 8,
                title: "Cheap Villa !!!!!!",
                content: "A very Cheap Villa !!!!!!"
            },
        ];

        this.loading = false;
    }
}
</script>