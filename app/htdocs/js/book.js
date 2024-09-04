function deleteUser(id, title) {
    alert(`本当に削除しますか？${title}`);
    document.delete_form.id.value = id;
    document.delete_form.submit();
}