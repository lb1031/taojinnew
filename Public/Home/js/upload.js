var Upload = function (config, fileInput, replaceSpan, parentArea, submitBtn, url) {
	this.config = {
		maxSize: 0,          // 0为无限制
		exts: null,          // 允许后缀名
		progessEvent: true,  // 是否需要进度条(大文件,如：视频)
		progessWidth: 500,   // 进度条宽度
		preview: true,       // 是否需要预览(图片)	
		unique: false        // 只是允许上传一个文件
	};
	this.files = [];
	this.error = "";
	this.parentArea = parentArea || document.body;
	if (config) {
		Upload.init.call(this, config, fileInput);
	}
	this.init.call(this, fileInput, replaceSpan);
	// submitBtn.onclick = this.send.bind(this, url);
};
Upload.init = function (obj, element) {
	var keys = Object.keys(obj);
	for (var i = 0, key; key = keys[i++];) {
		this.config[key] = obj[key];
	}
	if (this.config.preview) {
		this.previewDivs = [];
		this.previewArea = document.createElement("div");
		this.previewArea.setAttribute("class", "previewArea");
		this.parentArea.appendChild(this.previewArea);
		this.bindDelete(element);
	} else {
		this.previewArea = document.createElement("strong");
		this.previewArea.setAttribute("class", "fileName");
		this.parentArea.appendChild(this.previewArea);
	}
};
// 除去数组中的false值
Upload.reduceNull = function (arr) {
	return arr.filter(function (val) {
		return val;
	});
};
// 上传进度条
Upload.ajaxProgress = function (xhr, width) {
	xhr.upload.onprogress = function (event) {
		var divStatus = document.getElementById("status");
		if (event.lengthComputable) {
			divStatus.style.display = "block";
			divStatus.style.width = Math.round(event.loaded / event.total * width) + "px";
		}
	};
};
Upload.prototype.init = function (element, replaceEle) {
	var self = this;
	if (replaceEle) {
		replaceEle.onclick = function () {
			element.click();
		};
	}
	element.onchange = function () {
		if (element.value === "") return void 0;
		var file = element.files[0];
		if ( (!self.config.maxSize || self.checkSize.call(self, file.size)) 
			&& (!self.config.exts || self.checkExts.call(self, file.type)) ) {
			self.files.push(file);
			self.preview.call(self, file);
		} else {
			alert(self.error);
		}
	};
};
Upload.prototype.checkSize = function (size) {
	if (size && size <= this.config.maxSize) {
		return true;
	} else {
		this.error = "上传文件过大";
	}
};
Upload.prototype.checkExts = function (type) {
	var type = type && type.substr(type.indexOf("/") + 1);
	if (this.config.exts.indexOf(type) !== -1) {
		return true;
	} else {
		this.error = "上传文件格式不符合要求";
	}
};
// 图片预览
Upload.prototype.preview = function (file) {
	if (!this.config.preview) {
		if (this.config.unique) {
			this.files.length > 1 ? this.files.shift() : 1;
			this.previewArea.innerText = file.name;
		} else {
			this.previewArea.innerText += file.name;
		}
		return void 0;
	}
	var self = this;
		reader = new FileReader();
	reader.onload = function (e) {
		var span = document.createElement("div");
		var str = "<strong>" 
		// + file.name 
		+ "</strong><a href='javascript:void(0);' class='deletePreview' title='删除' data-index='" 
				  + (self.files.length - 1) + "'>x</a><img src='" + e.target.result + "'>";
		span.innerHTML += str;
		self.previewDivs.push(span);
		if (self.config.unique) {
			self.files.length > 1 ? self.files.shift() : 1;
			self.previewArea.childNodes.length === 1 ? self.previewArea.removeChild(self.previewArea.childNodes[0]) : 1;
			self.previewArea.appendChild(span);
		} else {
			self.previewArea.appendChild(span);
		}
	};
	reader.readAsDataURL(file);
};
Upload.prototype.bindDelete = function (element) {
	var _this = this;
	this.previewArea.onclick = function (e) {
		var self = this;
		if (e.target.className === "deletePreview") {
			var index = e.target.getAttribute("data-index");
			_this.files[index] = undefined;
			self.removeChild(_this.previewDivs[index]);
			_this.previewDivs[index] = undefined;
			element.value = "";
		}
	};
};
Upload.prototype.send = function (url) {
	var xhr = new XMLHttpRequest(),
		self = this;
		data = new FormData();
	const width = self.config.progessWidth;
	this.files = Upload.reduceNull(this.files);
	
	if (!this.files.length) {
		alert("请选择上传文件");
		return void 0;
	}
	
	data.append("length", this.files.length);
	for (var i = 0, len = this.files.length; i < len; i++) {
		data.append("filename" + i, this.files[i]);
	}

	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status >= 200 && xhr.status < 300) {
				alert(JSON.parse(xhr.responseText));
			} else {
				alert("请求失败");
			}
		}
	};

	if (self.config.progessEvent) {
		Upload.ajaxProgress(xhr, width);
	}

	xhr.open("post", url, true);
	xhr.send(data);
};
