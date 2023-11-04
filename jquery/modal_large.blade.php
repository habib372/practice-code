<style>
    /* Style the modal */
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 50px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        }

        /* Style the close button */
        .close {
        color: #fff;
        position: absolute;
        top: 15px;
        right: 35px;
        font-size: 30px;
        cursor: pointer;
        }

        /* Style the image inside the modal */
        .modal-content {
        display: block;
        margin: 0 auto;
        max-width: 80%;
        max-height: 80%;
        }

        /* Style the image in your table */
        .attachment_view {
        cursor: pointer;
        }

</style>

<table class="table">
    <tr>
        <td>
            <h6>Patient Attachment Files </h6>
            @if($attachments)
            @foreach ($attachments as $item)
            <img data-toggle="modal" data-target="#exampleModal_{{ $item->id }}" class="attachment_view"
                src="{{ asset('uploads/sponsorship-attachments/'.$item->file_original_name) }}" width="80px">
            @endforeach
            @else
            No Image Found
            @endif
        </td>
        <td>
            <h6>Doctor Referral Letter </h6>
            @if($data->doctor_recommend_letter)
            <img data-toggle="modal" data-target="#exampleModal_{{ $data->id }}" class="attachment_view"
                src="{{ asset('uploads/sponsorship_referral_letter/'.$data->doctor_recommend_letter) }}" width="80px">
            @else
            No Image Found
            @endif
        </td>
    </tr>
</table>

<!-- The Modal -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img id="fullImage" class="modal-content">
</div>

<script>
    // Function to open the modal and display the clicked image
    function openModal(imageSrc) {
        var modal = document.getElementById("imageModal");
        var fullImage = document.getElementById("fullImage");
        fullImage.src = imageSrc;
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }

    // Attach a click event handler to your images
    var images = document.querySelectorAll(".attachment_view");
    images.forEach(function (image) {
        image.addEventListener("click", function () {
            openModal(this.src);
        });
    });
</script>