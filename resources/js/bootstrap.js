import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import Tooltip from "@ryangjchandler/alpine-tooltip";
// import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'

Alpine.plugin(collapse)
Alpine.plugin(Tooltip);
// Alpine.plugin(FormsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling

