//filepond
const fileInput = document.querySelector('input[id="fileAttachment"]');
const fileAttachmentList = document.querySelector('#fileAttachmentList');

if(fileInput && fileAttachmentList) {
    const pond = FilePond.create( fileInput, {
        server: {
            url: `/fileattachment/upload/${fileInput.dataset.transactiontype}/${fileInput.dataset.transactionid}/${fileInput.dataset.userid}`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            process: {
                onload: (res) => {
                    let file = JSON.parse(res);
                    
                    //create element
                    let li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `<a href="/storage/fileattachments/${file.transaction_type}/${file.filename}" target="_blank">${file.original_filename}</a>
                                    <a data-toggle="modal" data-target="#modalDeleteFileAttachment${file.id}" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i></a>
                                    `
                    li.innerHTML += deleteFileModal(file.id, file.original_filename);
                    fileAttachmentList.append(li);
                }
            },
            
        },
        allowRevert: false,
    } );
}

let deleteFileModal =  function(id,filename) {
    return `
    <div class="modal fade" id="modalDeleteFileAttachment${id}" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete File Attachment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/fileattachment/delete/${id}" method="POST">
          <div class="modal-body">
            <p>Please confirm to delete file: ${filename}</p>
            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
            <input type="hidden" name="id" value="${id}">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-danger">Delete File</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    `;
}