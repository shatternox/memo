const fetchMemo = async (event)=>{
    const inputData = $('#checkMemoSubmitBtn').val()
    const url = `http://admin/admin_check?url=${inputData}`

    await fetch(url)
}

$('#checkMemoSubmitBtn').on("click",fetchMemo)