import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="default" attribute will cause
 * this controller to be executed. The name "default" comes from the filename:
 * default_controller.js -> "default"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        this.element.textContent = 'This is a short message from Stimulus. Edit the default controller in assets/controllers/default_controller.js';
    }
}
