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
