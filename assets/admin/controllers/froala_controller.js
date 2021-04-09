import { Controller } from 'stimulus';
import FroalaEditor from 'froala-editor';
import 'froala-editor/js/plugins/align.min';
import 'froala-editor/js/plugins/code_view.min';
import 'froala-editor/js/plugins/draggable.min';
import 'froala-editor/js/plugins/file.min';
import 'froala-editor/js/plugins/files_manager.min';
import 'froala-editor/js/plugins/image.min';
import 'froala-editor/js/plugins/image_manager.min';
import 'froala-editor/js/plugins/inline_class.min';
import 'froala-editor/js/plugins/inline_style.min';
import 'froala-editor/js/plugins/link.min';
import 'froala-editor/js/plugins/lists.min';
import 'froala-editor/js/plugins/paragraph_format.min';
import 'froala-editor/js/plugins/table.min';
import 'froala-editor/js/plugins/url.min';
import 'froala-editor/js/plugins/video.min';
import 'froala-editor/js/plugins/help.min';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  connect() {
    new FroalaEditor(this.element.getElementsByTagName('textarea')[0], {
      heightMin: 400,
    });
  }
}
