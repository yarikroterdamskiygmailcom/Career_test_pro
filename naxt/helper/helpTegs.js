export class Tag {
    static getArrayTags(meta) {
        return [
            {name: 'keywords',    content: meta && meta.meta_keywords ? meta.meta_keywords : ''},
            {name: 'description', content: meta && meta.meta_data     ? meta.meta_data     : ''},
            {name: 'title',       content: meta && meta.meta_title    ? meta.meta_title    : ''}
        ]
    }
}
