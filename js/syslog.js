(function () {
    'use strict';

    var dialog = document.getElementById('debug-log-dialog');
    if (!dialog) {
        return;
    }

    var body = document.getElementById('debug-log-body');
    var loading = document.getElementById('debug-log-loading');
    var footer = document.getElementById('debug-log-footer');
    var fileLabel = document.getElementById('debug-log-file');
    var refreshBtn = document.getElementById('debug-log-refresh');
    var closeBtn = document.getElementById('debug-log-close');
    var badge = document.getElementById('debug-page-ok');

    var LIMIT = 300;
    var MESSAGES = window.DebugLogMessages || {};
    var state = {
        startOffset: 0,
        hasMore: true,
        loading: false,
        open: false
    };

    function getUrl(params) {
        var url = dialog.getAttribute('data-url');
        var parts = [];
        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                parts.push(encodeURIComponent(key) + '=' + encodeURIComponent(params[key]));
            }
        }
        return parts.length ? url + '?' + parts.join('&') : url;
    }

    function fetchBlock(endOffset) {
        var params = { limit: LIMIT };
        if (endOffset !== null) {
            params.end_offset = endOffset;
        }
        return fetch(getUrl(params)).then(function (response) {
            return response.json();
        });
    }

    function setLoading(show) {
        loading.hidden = !show;
    }

    function createLine(line) {
        var div = document.createElement('div');
        div.className = 'debug-log-line debug-log-' + (line.level || 'default');
        div.textContent = line.text;
        return div;
    }

    function renderLines(lines, prepend) {
        var fragment = document.createDocumentFragment();
        for (var i = 0; i < lines.length; i++) {
            fragment.appendChild(createLine(lines[i]));
        }
        if (!fragment.childNodes.length) {
            return false;
        }
        if (prepend) {
            var previousHeight = body.scrollHeight;
            var previousScrollTop = body.scrollTop;
            body.insertBefore(fragment, body.firstChild);
            body.scrollTop = previousScrollTop + (body.scrollHeight - previousHeight);
        } else {
            body.appendChild(fragment);
            body.scrollTop = body.scrollHeight;
        }
        return true;
    }

    function showError(message) {
        body.innerHTML = '';
        body.appendChild(createLine({ text: message, level: 'err' }));
    }

    function appendError(message) {
        var line = createLine({ text: message, level: 'err' });
        body.insertBefore(line, body.firstChild);
    }

    function updateHasMore(hasMore) {
        state.hasMore = hasMore;
        footer.classList.toggle('hidden', !hasMore);
    }

    function loadOlder() {
        if (state.loading || !state.hasMore) {
            return;
        }
        state.loading = true;
        setLoading(true);
        fetchBlock(state.startOffset).then(function (data) {
            state.loading = false;
            setLoading(false);
            if (data.error) {
                appendError(data.error);
                updateHasMore(false);
                return;
            }
            if (data.start_offset === state.startOffset) {
                updateHasMore(false);
                return;
            }
            if (renderLines(data.lines, true)) {
                state.startOffset = data.start_offset;
            }
            updateHasMore(data.has_more);
        }).catch(function () {
            state.loading = false;
            setLoading(false);
            appendError(MESSAGES.network || 'Network error');
            updateHasMore(false);
        });
    }

    function openViewer() {
        if (state.loading) {
            return;
        }
        body.innerHTML = '';
        fileLabel.textContent = '';
        state.startOffset = 0;
        state.loading = true;
        setLoading(true);
        footer.classList.remove('hidden');
        fetchBlock(null).then(function (data) {
            state.loading = false;
            setLoading(false);
            if (data.error) {
                showError(data.error);
                return;
            }
            fileLabel.textContent = data.file || '';
            state.startOffset = data.start_offset;
            renderLines(data.lines, false);
            updateHasMore(data.has_more);
        }).catch(function () {
            state.loading = false;
            setLoading(false);
            showError(MESSAGES.network || 'Network error');
        });
    }

    function openModal() {
        if (state.open) {
            return;
        }
        state.open = true;
        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }
        openViewer();
    }

    function closeModal() {
        state.open = false;
        if (typeof dialog.close === 'function') {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
        }
    }

    if (badge) {
        badge.addEventListener('click', function () {
            if (state.open) {
                closeModal();
            } else {
                openModal();
            }
        });
    }

    if (refreshBtn) {
        refreshBtn.addEventListener('click', function () {
            if (state.open) {
                openViewer();
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) {
            closeModal();
        }
    });

    dialog.addEventListener('close', function () {
        state.open = false;
    });

    body.addEventListener('scroll', function () {
        if (body.scrollTop <= 0) {
            loadOlder();
        }
    });
})();
