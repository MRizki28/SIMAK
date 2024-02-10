function paramsUrl(url, params) {
    if (params) {
        return url + '?' + $.param(params)
    }
    return url
}

function paginationLink(element, params) {
    params.data.links.forEach((link, index) => {
        if (index === 0) {
            element.append(`
                <li class="page-item">
                    <a class="page-link" href="${params.data.prev_page_url || '#'}" aria-label="Previous" id="pagination-prev" >
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            `)
        } else if (index === params.data.links.length - 1) {
            element.append(`
                <li class="page-item">
                    <a class="page-link" href="${params.data.next_page_url || '#'}" aria-label="Next" id="pagination-next" >
                        <span aria-hidden="true">»</span></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            `)
        } else {
            element.append(`
                <li class="page-item ${link.active ? 'active' : ''}"><a class="page-link" href="${link.url}">${link.label}</a></li>
            `)
        }
    })
}