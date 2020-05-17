@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-2">
        <div id="posts" class="col-12 col-lg-8 mr-0 mr-sm-5">
            @include("posts._cards")
        </div>
        <div class="col-lg-3 d-none d-lg-block border text-center h-75 descubre">
            @include("posts._discover")
        </div>
    </div>
</div>


<script type="application/javascript">

    var pagina = 2
    var peticion = false

    window.onscroll = () => {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 1) {
            if(!peticion){
                peticion = true

                fetch(`/pages?page=${pagina}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                        if (document.getElementById('upsi') == null) {
                            document.getElementById('posts').innerHTML += html
                        }
                        pagina++
                        peticion = false
                })
                .catch(error => console.log(error))

            }
        }

    }

</script>

    <!--var endless = {
  page: 0, // "current page",
  hasMore: true, // not at the end, has more contents
  proceed: true, // load the next page?

  load: function () {
    if (endless.proceed && endless.hasMore) {
      // Prvent user from loading too much contents suddenly
      // Block the loading until this one is done
      endless.proceed = false;

      // Load the next page
      var data = new FormData(),
          nextPg = endless.page + 1,
          loading = document.getElementById("page-loading");
      data.append('page', nextPg);

      // Show loading message or spinner
      loading.style.display = "block";

      // AJAX request
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "ajax-contents.php", true);
      xhr.onload = function () {
        // No more contents to load
        if (this.response == "END") {
          loading.innerHTML = "END";
          endless.hasMore = false;
        }

        // Contents loaded
        else {
          // Append into container + hide loading message
          var el = document.createElement('div');
          el.innerHTML = this.response;
          document.getElementById("page-content").appendChild(el);
          loading.style.display = "none";
          // Set the current page, unblock loading
          endless.page = nextPg;
          endless.proceed = true;
        }
      };
      xhr.send(data);
    }
  },

  listen: function(){
    // Get the height of the entire document
    var height = document.documentElement.offsetHeight,
    // Get the current offset - how far "scrolled down"
    offset = document.documentElement.scrollTop + window.innerHeight;

    // Check if user has hit the end of page
    // console.log('Height: ' + height);
    // console.log('Offset: ' + offset);
    if (offset === height) {
      endless.load();
    }
  }
};

window.onload = function () {
  // Attach scroll listener
  window.addEventListener("scroll", endless.listen);

  // Initial load contents
  endless.load();
};-->
@endsection

