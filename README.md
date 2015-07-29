# qatest
QA Test Repository to sync with Jira
Test 1

Introduction

HTML20 finally provides a standard way to interact with local files, via the File API specification. As example of its capabilities, the File API could be used to create a thumbnail preview of images as they're being sent to the server, or allow an app to save a file reference while the user is offline. Additionally, you could use client-side logic to verify an upload's mimetype matches its file extension or restrict the size of an upload.

The spec provides several interfaces for accessing files from a 'local' filesystem:

File - an individual file; provides readonly information such as name, file size, mimetype, and a reference to the file handle.
FileList - an array-like sequence of File objects. (Think <input type="file" multiple> or dragging a directory of files from the desktop).
Blob - Allows for slicing a file into byte ranges.
When used in conjunction with the above data structures, the FileReader interface can be used to asynchronously read a file through familiar JavaScript event handling. Thus, it is possible to monitor the progress of a read, catch errors, and determine when a load is complete. In many ways the APIs resemble XMLHttpRequest's event model.

Selecting files

The first thing to do is check that your browser fully supports the File API:

// Check for the various File API support.
if (window.File && window.FileReader && window.FileList && window.Blob) {
  // Great success! All the File APIs are supported.
} else {
  alert('The File APIs are not fully supported in this browser.');
}
Of course, if your app will only use a few of these APIs, modify this snippet accordingly.

Using form input for selecting

The most straightforward way to load a file is to use a standard <input type="file"> element. JavaScript returns the list of selected File objects as a FileList. Here's an example that uses the 'multiple' attribute to allow selecting several files at once:

<input type="file" id="files" name="files[]" multiple />
<output id="list"></output>

<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                  '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
Example: Using form input for selecting. Try it!
