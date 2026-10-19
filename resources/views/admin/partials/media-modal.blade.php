<!-- Media Picker Modal (WordPress-style) with SEO Image Optimization -->
<div id="cmsMediaModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-900/80 backdrop-blur-sm hidden" style="display: none;">
    <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[92vh]">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div class="flex items-center gap-6">
                <h3 class="font-bold text-slate-800 text-base flex items-center gap-2">
                    <i data-lucide="image" class="w-5 h-5 text-brand-600"></i>
                    <span>Media Library &amp; SEO Image Picker</span>
                </h3>
                <!-- Tabs: Library vs Upload -->
                <div class="flex items-center bg-slate-200/80 p-0.5 rounded-lg text-xs font-semibold">
                    <button type="button" id="tabLibraryBtn" onclick="switchMediaTab('library')" class="px-3 py-1.5 rounded-md bg-white text-slate-900 shadow-sm transition">Media Library</button>
                    <button type="button" id="tabUploadBtn" onclick="switchMediaTab('upload')" class="px-3 py-1.5 rounded-md text-slate-600 hover:text-slate-900 transition">Upload Files</button>
                </div>
            </div>
            <button type="button" onclick="closeMediaModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Tab 1: Library & Metadata Editor -->
        <div id="mediaTabLibrary" class="flex-1 flex flex-col md:flex-row overflow-hidden">
            <!-- Left: Grid & Search -->
            <div class="flex-1 flex flex-col overflow-hidden border-r border-slate-200">
                <!-- Search bar -->
                <div class="p-3.5 border-b border-slate-100 flex items-center justify-between gap-4 bg-slate-50/50">
                    <div class="relative flex-1 max-w-xs">
                        <input type="text" id="modalMediaSearch" onkeyup="filterMediaModal(this.value)" placeholder="Search media by name or alt text..."
                               class="w-full pl-8 pr-3 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                        <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5"></i>
                    </div>
                    <span id="modalMediaCount" class="text-xs text-slate-500">Loading...</span>
                </div>

                <!-- Grid container -->
                <div class="flex-1 overflow-y-auto p-4">
                    <div id="modalMediaGrid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                        <!-- Populated via JS -->
                    </div>
                    <div id="modalMediaEmpty" class="hidden py-12 text-center text-slate-400 text-xs">
                        No media items found. Upload some files first!
                    </div>
                </div>
            </div>

            <!-- Right: Attachment Details & Live SEO Editor -->
            <div id="modalSidebarDetails" class="w-full md:w-80 bg-slate-50 p-4 border-t md:border-t-0 border-slate-200 overflow-y-auto hidden">
                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                        <h4 class="text-xs font-black uppercase tracking-wider text-slate-700">Attachment Details</h4>
                        <span id="modalDetailBadge" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">SEO Ready</span>
                    </div>

                    <!-- Thumbnail & Info -->
                    <div class="flex items-center gap-3 bg-white p-2.5 rounded-xl border border-slate-200">
                        <img id="modalPreviewImg" src="" alt="" class="w-16 h-16 object-cover rounded-lg bg-slate-100">
                        <div class="text-[11px] text-slate-600 space-y-0.5 overflow-hidden">
                            <p id="modalPreviewFilename" class="font-bold text-slate-900 truncate font-mono"></p>
                            <p id="modalPreviewMeta" class="text-slate-400"></p>
                        </div>
                    </div>

                    <!-- SEO Fields Form -->
                    <div class="space-y-3 bg-white p-3.5 rounded-xl border border-slate-200 text-xs">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Image Title</label>
                            <input type="text" id="modalEditTitle" onchange="markMetaDirty()"
                                   placeholder="Descriptive image title"
                                   class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Alt Text (Accessibility &amp; SEO)</label>
                            <input type="text" id="modalEditAlt" onchange="markMetaDirty()"
                                   placeholder="Describe image content and topic"
                                   class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                            <p class="text-[10px] text-slate-400 mt-1">Automatically optimized for Google Image Search.</p>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Caption (Optional)</label>
                            <textarea id="modalEditCaption" rows="2" onchange="markMetaDirty()"
                                      placeholder="Leave blank unless technical explanation is needed"
                                      class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20"></textarea>
                        </div>

                        <div class="pt-1">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="modalEditDecorative" onchange="toggleDecorativeMode(this.checked)" class="rounded text-brand-600 focus:ring-brand-500">
                                <span class="text-[11px] text-slate-600 font-medium">Decorative image (empty alt="")</span>
                            </label>
                        </div>

                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <button type="button" id="modalSaveMetaBtn" onclick="saveSelectedMediaMeta()"
                                    class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-bold transition">
                                Save Details
                            </button>
                            <span id="modalSaveStatus" class="text-[10px] text-emerald-600 font-bold hidden">Saved!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Upload Files with Context -->
        <div id="mediaTabUpload" class="flex-1 overflow-y-auto p-8 hidden" style="display: none;">
            <div class="max-w-xl mx-auto space-y-4">
                <!-- Page Topic Context Input -->
                <div class="bg-amber-50/70 border border-amber-200/80 p-4 rounded-2xl space-y-2">
                    <label class="block text-xs font-bold text-amber-950 flex items-center gap-1.5">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-600"></i>
                        <span>Active Page Topic / Context (for Automatic SEO Optimization)</span>
                    </label>
                    <input type="text" id="modalUploadContext" 
                           placeholder="e.g. 500 kVA Generator Rental in UAE or Air Cooled Chiller Hire"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-amber-300 bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                    <p class="text-[11px] text-amber-900/80 leading-relaxed">
                        The system uses this topic to automatically generate keyword-rich filenames, accurate alt text, and SEO titles upon upload. If left empty, intelligent fallback heuristics are used.
                    </p>
                    <div class="pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="modalUploadDecorative" class="rounded text-amber-600 focus:ring-amber-500">
                            <span class="text-xs text-amber-950 font-semibold">Mark files as decorative (empty alt text)</span>
                        </label>
                    </div>
                </div>

                <!-- Dropzone -->
                <div class="border-2 border-dashed border-slate-300 hover:border-brand-500 rounded-2xl p-8 text-center bg-slate-50 transition cursor-pointer" onclick="document.getElementById('modalFileInput').click()">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-700">Drop images here to upload or <span class="text-brand-600 underline">browse</span></p>
                    <p class="text-xs text-slate-400 mt-1">Max 20MB. Images are automatically converted to WebP with SEO optimization.</p>
                    <input type="file" id="modalFileInput" multiple class="hidden" onchange="handleModalFileUpload(this.files)">
                </div>

                <div id="modalUploadProgress" class="mt-4 hidden">
                    <div class="text-xs text-slate-600 font-semibold mb-1">Uploading and optimizing for SEO...</div>
                    <div class="w-full bg-slate-200 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-brand-600 h-full w-0 transition-all duration-300" id="modalProgressBar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-3 border-t border-slate-200 bg-slate-50 flex items-center justify-between">
            <div class="text-xs text-slate-500 truncate max-w-md" id="modalSelectedInfo">
                No item selected
            </div>
            <div class="flex items-center gap-2">
                <button type="button" onclick="closeMediaModal()" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition">Cancel</button>
                <button type="button" id="modalSelectBtn" onclick="confirmMediaSelection()" disabled class="px-4 py-2 text-xs font-semibold text-white bg-brand-600 disabled:opacity-50 disabled:cursor-not-allowed rounded-lg hover:bg-brand-700 transition flex items-center gap-1.5">
                    <span>Insert Selected</span>
                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentMediaCallback = null;
    let selectedMediaItem = null;
    let loadedMediaItems = [];

    function getActivePageContext() {
        const postTitle = document.getElementById('postTitle')?.value?.trim();
        const prodTitle = document.getElementById('productTitle')?.value?.trim();
        const servTitle = document.getElementById('serviceTitle')?.value?.trim();
        const pageTitle = document.getElementById('pageTitle')?.value?.trim();
        const h1 = document.querySelector('h1')?.textContent?.trim();
        return postTitle || prodTitle || servTitle || pageTitle || window.currentUploadContext || h1 || '';
    }

    function openMediaModal(callback) {
        currentMediaCallback = callback;
        selectedMediaItem = null;
        document.getElementById('modalSelectBtn').disabled = true;
        document.getElementById('modalSelectedInfo').textContent = 'No item selected';
        document.getElementById('modalSidebarDetails').classList.add('hidden');
        
        // Populate context
        const contextInput = document.getElementById('modalUploadContext');
        if (contextInput) {
            contextInput.value = getActivePageContext();
        }

        document.getElementById('cmsMediaModal').style.display = 'flex';
        switchMediaTab('library');
        fetchModalMedia();
    }

    function closeMediaModal() {
        document.getElementById('cmsMediaModal').style.display = 'none';
        currentMediaCallback = null;
        selectedMediaItem = null;
    }

    function switchMediaTab(tab) {
        const libTab = document.getElementById('mediaTabLibrary');
        const upTab = document.getElementById('mediaTabUpload');
        const libBtn = document.getElementById('tabLibraryBtn');
        const upBtn = document.getElementById('tabUploadBtn');

        if (tab === 'library') {
            libTab.style.display = 'flex';
            upTab.style.display = 'none';
            libBtn.className = 'px-3 py-1.5 rounded-md bg-white text-slate-900 shadow-sm transition';
            upBtn.className = 'px-3 py-1.5 rounded-md text-slate-600 hover:text-slate-900 transition';
        } else {
            libTab.style.display = 'none';
            upTab.style.display = 'block';
            upBtn.className = 'px-3 py-1.5 rounded-md bg-white text-slate-900 shadow-sm transition';
            libBtn.className = 'px-3 py-1.5 rounded-md text-slate-600 hover:text-slate-900 transition';
            
            // Re-sync context in case title changed
            const contextInput = document.getElementById('modalUploadContext');
            if (contextInput && !contextInput.value) {
                contextInput.value = getActivePageContext();
            }
        }
    }

    function fetchModalMedia(search = '') {
        const url = '{{ route("admin.media.modal-list") }}' + (search ? '?search=' + encodeURIComponent(search) : '');
        fetch(url, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => {
                loadedMediaItems = data;
                renderModalMedia(data);
            })
            .catch(err => console.error(err));
    }

    function renderModalMedia(items) {
        const grid = document.getElementById('modalMediaGrid');
        const empty = document.getElementById('modalMediaEmpty');
        const count = document.getElementById('modalMediaCount');
        
        count.textContent = items.length + ' items';
        grid.innerHTML = '';

        if (items.length === 0) {
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');

        items.forEach(item => {
            const card = document.createElement('div');
            card.className = 'relative aspect-square rounded-lg border border-slate-200 overflow-hidden cursor-pointer group bg-slate-100 hover:border-brand-500 transition-all';
            card.onclick = () => selectItemInModal(item, card);

            if (item.mime_type && item.mime_type.startsWith('image/')) {
                card.innerHTML = `
                    <img src="${item.url}" alt="${item.alt_text || item.title || item.name}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-brand-600/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    </div>
                `;
            } else {
                card.innerHTML = `
                    <div class="w-full h-full flex flex-col items-center justify-center p-2 text-slate-500">
                        <i data-lucide="file" class="w-6 h-6 mb-1"></i>
                        <span class="text-[9px] text-center line-clamp-2">${item.title || item.name}</span>
                    </div>
                `;
            }
            grid.appendChild(card);
        });

        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        } else if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    function selectItemInModal(item, el) {
        selectedMediaItem = item;
        document.querySelectorAll('#modalMediaGrid > div').forEach(c => {
            c.classList.remove('ring-4', 'ring-brand-500');
        });
        if (el) {
            el.classList.add('ring-4', 'ring-brand-500');
        }
        document.getElementById('modalSelectBtn').disabled = false;
        document.getElementById('modalSelectedInfo').textContent = 'Selected: ' + (item.title || item.name) + ' (' + (item.dimensions || item.human_size) + ')';

        // Populate right sidebar details
        const sidebar = document.getElementById('modalSidebarDetails');
        sidebar.classList.remove('hidden');

        document.getElementById('modalPreviewImg').src = item.url;
        document.getElementById('modalPreviewFilename').textContent = item.file_name;
        document.getElementById('modalPreviewMeta').textContent = (item.dimensions ? item.dimensions + ' px • ' : '') + item.human_size;

        document.getElementById('modalEditTitle').value = item.title || item.name || '';
        document.getElementById('modalEditAlt').value = item.alt_text || '';
        document.getElementById('modalEditCaption').value = item.caption || '';
        
        const decorCheckbox = document.getElementById('modalEditDecorative');
        decorCheckbox.checked = !!item.is_decorative;
        toggleDecorativeMode(decorCheckbox.checked);

        document.getElementById('modalSaveStatus').classList.add('hidden');
    }

    function toggleDecorativeMode(isDecorative) {
        const altInput = document.getElementById('modalEditAlt');
        if (isDecorative) {
            altInput.value = '';
            altInput.placeholder = 'Decorative image (empty alt="" will be rendered)';
            altInput.disabled = true;
            altInput.classList.add('bg-slate-100');
        } else {
            altInput.disabled = false;
            altInput.classList.remove('bg-slate-100');
            altInput.placeholder = 'Describe image content and topic';
        }
    }

    function markMetaDirty() {
        document.getElementById('modalSaveStatus').classList.add('hidden');
    }

    function saveSelectedMediaMeta() {
        if (!selectedMediaItem) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const title = document.getElementById('modalEditTitle').value;
        const isDecorative = document.getElementById('modalEditDecorative').checked;
        const altText = isDecorative ? '' : document.getElementById('modalEditAlt').value;
        const caption = document.getElementById('modalEditCaption').value;

        fetch('{{ url("admin/media") }}/' + selectedMediaItem.id, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: title,
                title: title,
                alt_text: altText,
                caption: caption,
                is_decorative: isDecorative ? 1 : 0
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.media) {
                selectedMediaItem = data.media;
            }
            document.getElementById('modalSaveStatus').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('modalSaveStatus').classList.add('hidden');
            }, 2500);
        })
        .catch(err => alert('Failed to save metadata: ' + err.message));
    }

    function confirmMediaSelection() {
        if (selectedMediaItem && currentMediaCallback) {
            // Apply live input values if user made unsaved changes
            const isDecorative = document.getElementById('modalEditDecorative').checked;
            selectedMediaItem.is_decorative = isDecorative;
            selectedMediaItem.alt_text = isDecorative ? '' : document.getElementById('modalEditAlt').value;
            selectedMediaItem.title = document.getElementById('modalEditTitle').value || selectedMediaItem.name;
            selectedMediaItem.caption = document.getElementById('modalEditCaption').value;

            currentMediaCallback(selectedMediaItem);
            closeMediaModal();
        }
    }

    function filterMediaModal(term) {
        fetchModalMedia(term);
    }

    function handleModalFileUpload(files) {
        if (!files || files.length === 0) return;
        const formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        const context = document.getElementById('modalUploadContext')?.value?.trim();
        if (context) {
            formData.append('context', context);
        }

        const isDecorative = document.getElementById('modalUploadDecorative')?.checked;
        if (isDecorative) {
            formData.append('is_decorative', '1');
        }

        const progress = document.getElementById('modalUploadProgress');
        const bar = document.getElementById('modalProgressBar');
        progress.classList.remove('hidden');
        bar.style.width = '35%';

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route("admin.media.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            bar.style.width = '100%';
            setTimeout(() => {
                progress.classList.add('hidden');
                bar.style.width = '0%';
                switchMediaTab('library');
                fetchModalMedia();
                if (data.media && data.media.length > 0) {
                    selectItemInModal(data.media[0], null);
                }
            }, 500);
        })
        .catch(err => {
            alert('Upload failed: ' + err.message);
            progress.classList.add('hidden');
        });
    }
</script>
