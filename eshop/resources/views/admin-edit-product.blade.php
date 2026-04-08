@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/style.css'
    ])
@endpush

@section('title', '- add-product')

@section('content')
<main class="main_product">
<form>
<section class="product_section">

  <div class="product_gallery">

    <div class="thumbnails">
        <label class="thumb border border-gray">
            + 
            <input type="file" hidden>
        </label>
        <label class="thumb border border-gray">
            + 
            <input type="file" hidden>
        </label>
        <label class="thumb border border-gray">
            + 
            <input type="file" hidden>
        </label>
    </div>

    <div class="main_product_box">
      <img src="image/duck1.png" alt="preview">
    </div>

  </div>

  <div class="product_info">

    <label>Product name</label>
    <input type="text" class="form-control" maxlength="80" value="Super-duper Duck">

    <label>Description</label>
    <textarea class="form-control description" maxlength="500">
There will be basic information about the product
    </textarea>

    <label>Pcs in one package</label>
    <input type="number" class="form-control" value="20">

    <div class="quantity_control">
      <p>Stock:</p>
      <input type="number" value="10" min="0">
    </div>

    <label>Price (€)</label>
    <input type="number" class="form-control" value="49">

    <label>Category</label>
    <select class="form-select">
      <option>Funny</option>
      <option>Luxurious</option>
      <option>Seasonal</option>
    </select>

      <label>Accessories (Filters)</label>
      <div class="d-flex flex-wrap gap-3 mb-2">
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="hats">
              <label class="form-check-label" for="hats">Hats</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="glasses">
              <label class="form-check-label" for="glasses">Glasses</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="tie">
              <label class="form-check-label" for="tie">Tie</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="tshirt">
              <label class="form-check-label" for="tshirt">T-Shirt</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="jacket">
              <label class="form-check-label" for="jacket">Jacket</label>
          </div>
      </div>

      <div class="d-flex flex-wrap gap-3 mb-2">
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="student">
              <label class="form-check-label" for="student">Student</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="scientist">
              <label class="form-check-label" for="scientist">Scientist</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="whitecollar">
              <label class="form-check-label" for="whitecollar">White Collar</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="other">
              <label class="form-check-label" for="other">Other</label>
          </div>
      </div>

      <div class="d-flex flex-wrap gap-3">
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="weapons">
              <label class="form-check-label" for="weapons">Weapons</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="tools">
              <label class="form-check-label" for="tools">Tools</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="school">
              <label class="form-check-label" for="school">School</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sports">
              <label class="form-check-label" for="sports">Sports</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="diy">
              <label class="form-check-label" for="diy">DIY</label>
          </div>
      </div>

  </div>
</section>
</form>

<section class="specification">

    <div class="left_spec">
        <h2>Specification</h2>

        <table class="spec-table">
            <tr>
                <td><input type="text" class="form-control" value="Material"></td>
                <td><input type="text" class="form-control" value="Vinyl"></td>
                <td><button type="button" class="remove-button" aria-label="Remove Product from Cart">
                    <svg class="remove-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6l12 12"></path>
                        <path d="M18 6L6 18"></path>
                    </svg>
                </button></td>            </tr>

            <tr>
                <td><input type="text" class="form-control" value="Size"></td>
                <td><input type="text" class="form-control" value="10 cm"></td>
                <td><button type="button" class="remove-button" aria-label="Remove Product from Cart">
                    <svg class="remove-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6l12 12"></path>
                        <path d="M18 6L6 18"></path>
                    </svg>
                </button></td>            </tr>

            <tr>
                <td><input type="text" class="form-control" value="Weight"></td>
                <td><input type="text" class="form-control" value="200 g"></td>
                <td><button type="button" class="remove-button" aria-label="Remove Product from Cart">
                    <svg class="remove-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6l12 12"></path>
                        <path d="M18 6L6 18"></path>
                    </svg>
                </button></td>
            </tr>
        </table>

        <button type="button" class="btn btn-outline-primary btn-sm mt-2">
            + Add parameter
        </button>
    </div>

  <div class="right_spec">
    <h2>Customer Review</h2>
    <p class="text-muted small">How would you rate this product?</p>

    <form class="review-form">
        <div class="star-rating-admin mb-3">
            <label for="stars">★★★★★</label>
        </div>
    </form>

  </div>

</section>

<button class="btn btn-success w-100 mt-3 mb-3">Save changes</button>

</main>
@endsection