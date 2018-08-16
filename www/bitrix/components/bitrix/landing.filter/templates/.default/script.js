var landingAjaxSend = false;

BX.ready(function()
{
	// apply filter
	BX.addCustomEvent('BX.Main.Filter:apply', function()
	{
		if (landingAjaxSend)
		{
			return;
		}
		landingAjaxSend = true;

		var loading = BX.create('div',{
			props: {
				className: 'landing-filter-loading'
			}
		});
		var workArea = BX('workarea-content');
		var timeout = setTimeout(function()
		{
			workArea.appendChild(loading);
		}, 100);

		BX.ajax({
			method: 'POST',
			dataType: 'html',
			url: landingAjaxPath,
			onsuccess: function(data)
			{
				landingAjaxSend = false;
				clearTimeout(timeout);
				workArea.innerHTML = data;
			}
		});
	});

	// create folder
	var createFolderEl = BX('landing-create-folder');
	BX.bind(
		createFolderEl,
		'click',
		function()
		{
			var createFolderText = BX.create('input', {
				props: {
					type: 'text',
					className: 'landing-filter-folder-input'
				}
			});
			BX.focus(createFolderText);
			BX.Landing.UI.Tool.ActionDialog.getInstance()
				.show({
					title: createFolderEl.getAttribute('title'),
					content: createFolderText,
					confirm: BX.data(createFolderEl, 'action')
				})
				.then(
					function() {
						BX.ajax({
							url: '/bitrix/tools/landing/ajax.php?action=Landing::add',
							method: 'POST',
							data: {
								data: {
									fields: {
										TITLE: createFolderText.value,
										FOLDER: 'Y',
										SITE_ID: BX.data(createFolderEl, 'siteId')
									}
								},
								sessid: BX.message('bitrix_sessid')
							},
							dataType: 'json',
							onsuccess: function(data)
							{
								if (
									typeof data.type !== 'undefined' &&
									typeof data.result !== 'undefined'
								)
								{
									if (data.type === 'error')
									{
										var msg = BX.Landing.UI.Tool.ActionDialog.getInstance();
										msg.show({
											content: data.result[0].error_description,
											confirm: 'OK',
											type: 'alert'
										}).then(
											function()
											{
												BX.fireEvent(createFolderEl, 'click');
											}
										);
									}
									else
									{
										var url = BX.util.add_url_param(
											window.location.href,
											{
												folderId: data.result
											}
										);
										window.location.href = url;
									}
								}
							}
						});
					},
					function(error) {
						//
					}
				);
		}
	);
});