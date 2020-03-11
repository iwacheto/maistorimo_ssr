/* global context, dispatch */

import app from './app';
import renderVueComponentToString from 'vue-server-renderer/basic';


app.$router.push(context.url);
const meta = app.$meta();
context.meta = meta;

// app.$store.commit('setPackages', { packages: context.packages });

renderVueComponentToString(app, (err, html) => {
    if (err) {
        throw new Error(err);
    }
    const {
        title, htmlAttrs, headAttrs, bodyAttrs, link,
        style, script, noscript, meta
    } = context.meta.inject()
    dispatch(`
        <!DOCTYPE html>
          <head ${headAttrs.text()}>
            ${meta.text()}
            ${title.text()}
            ${link.text()}
            ${style.text()}
            ${script.text()}
            ${noscript.text()}
          </head>
          ${html}
  `);

});
