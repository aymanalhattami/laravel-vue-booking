<template>
    <div>
        <div class="form-gorup">
            <label for="rating" class="text-muted">Select star rating (1 is the worst - 5 is the best)</label>
            <star-rating 
                :rating="review.rating"
                @rating:changed="review.rating = $event"></star-rating>
        </div>

        <div class="form-group my-2">
            <label for="content" class="text-muted">Describe your experience</label>
            <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
        </div>

        <button class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                review:{
                    rating: 5,
                    content: null
                }
            }
        }
    }
</script>