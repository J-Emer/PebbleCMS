
console.log("------------hello world--------------");
 
var quill = new Quill('#editor', {
   theme: 'snow',
   placeholder: 'Compose an epic...',
   modules: {
       toolbar: [
           [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
           [{ 'list': 'ordered' }, { 'list': 'bullet' }],
           [{ 'align': [] }],
           ['bold', 'italic', 'underline'],
           ['link']
       ]
   }
});

var submitBtn = document.getElementById('submit-btn');
var titleInput = document.getElementById('title');
var slugText = document.getElementById('slug');


submitBtn.addEventListener('click', (e) => {

   e.preventDefault();  // Prevent default form submission

   console.log("------------form submited--------------");

   // Get form data
    var title = document.getElementById('title').value;
    var category = document.getElementById('category').value;
    var content = quill.root.innerHTML;  // Get HTML content from Quill editor
    var slug = slugText.textContent;
    var oldslug = document.getElementById('old-slug');

   // Log the data to console (You can process this data or send it to a server)
   console.log('Title:', title);
   console.log('Category:', category);
   console.log('Content:', content);
   console.log('Slug:', slug);
   console.log('Old Slug:', oldslug);
    


   // Example of sending data to a server via fetch
   var formData = new FormData();
   formData.append('title', title);
   formData.append('category', category);
   formData.append('content', content);
   formData.append('slug', slug);
   formData.append('oldslug', oldslug);
    


   // Send data using Fetch API (Replace '/your-server-endpoint' with your actual endpoint)
   fetch('/admin/posts/addnewpost', {
       method: 'POST',
       body: formData
   })
   .then(response => response.json())  // Assume the server returns JSON
   .then(data => {
       console.log('Success:', data); //---show a success popup?
       if (data.success)
       {
           window.location.href = '/admin/posts';
       }
   })
   .catch(error => {
       console.error('Error:', error);//---show error message, stay on same page
   });

});


titleInput.addEventListener('change', (e) => {
   slugText.textContent = generateSlug(titleInput.value);
});

function generateSlug(title) {
   return title
       .toLowerCase()  // Convert to lowercase
       .trim()  // Remove leading and trailing spaces
       .replace(/[^a-z0-9 -]/g, '')  // Remove non-alphanumeric characters except spaces and hyphens
       .replace(/\s+/g, '-')  // Replace spaces with hyphens
       .replace(/-+/g, '-')  // Replace multiple hyphens with a single hyphen
       .replace(/^-+/, '')  // Remove leading hyphens
       .replace(/-+$/, '');  // Remove trailing hyphens
}

