<style>
    .star_rating span{
        font-size:30px;
    }
</style>
<div>
    <div wire:ignore.self id="add_evaluation" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Evaluation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                <label>Please select the Evaluations type <span
                                        class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2 form-control select" 
                                    name="employee_id" required>
                                    <option value="">Select employee</option>
                                    @forelse ($Evaluations_types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->name }}</option>
                                    @empty
                                        <option value="">No employee eligible for account is found.</option>
                                    @endforelse
                                </select>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Performance <span
                                        class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="" id="">
                            </div>
                            <div class="col-md-12">
                                <label for="">Performance <span
                                        class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="" id="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <label for="">Rating :<span class="RatingAmount"></span></label>
                                <input type="text" class="total-rating" value="3">
                                <div class="star_rating">
			                        <span data-rating="1">☆</span>
			                        <span data-rating="2">☆</span>
			                        <span data-rating="3">☆</span>
			                        <span data-rating="4">☆</span>
			                        <span data-rating="5">☆</span>
		                        </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button wire:click.prevent="store" wire:loading.attr="disabled" type="submit"
                                class="btn btn-lg btn-primary submit-btn">
                                <span wire:loading.remove wire:target="store">Add Now</span>
                                <span class="d-none" wire:loading.class.remove="d-none"
                                    wire:target="store">Adding Please wait...
                                    <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status"
                                        aria-hidden="true">
                                    </span>
                                </span>
                            </button>
                            Rating: 
                        </div>
                    </form>
                </div>
            </div>
        </div>
     
    </div>
</div>
<script>
	var stars;
	document.addEventListener('DOMContentLoaded', () => {
		stars = document.querySelectorAll(".star_rating span");
		stars.forEach(item => {
			item.addEventListener('click', function () {
				var rating = this.getAttribute("data-rating");
				document.querySelector(".RatingAmount").innerText = rating;
				return SetRatingStar(rating, stars);
			});
		});
	});

/**
* SetRatingStar sets the rating on page
*
* @param {int} rating           Int of the rating value. 
* @returns {object} stars       html stars elements
*
*/


var data =document.querySelector('.total-rating').value;
	function SetRatingStar(rating, stars) {
		var len = stars.length;
		console.log(rating);

		for (var i = 0; i < len; i++) {
			if (i < rating) {
				stars[i].innerHTML = '★';
			} else {
				stars[i].innerHTML = '☆';
			}
		}

	};
</script>