
<% if $CookieTypes %>
<% loop $CookieTypes %>
<p>
	<strong>$Title</strong>
	<% if $Subtitle %><br>$Subtitle<% end_if %>
	<% if $Description %><br>$Description<% end_if %>
</p>
<% end_loop %>
<% end_if %>

<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th><%t Cookie.LabelName 'Cookie Name' %></th>
				<th><%t Cookie.LabelSource 'Herkunft' %></th>
				<th><%t Cookie.LabelDescription 'Beschreibung' %></th>
				<th><%t Cookie.LabeltExpirationTime 'Ablaufzeit' %></th>
				<th><%t Cookie.LabeltType 'Typ' %></th>
			</tr>
		</thead>
		<tbody>
			<% loop $Cookies %>
			<tr>
				<td>$Title</td>
				<td>$Source</td>
				<td class="text-wrap">$Description</td>
				<td>$ExpirationTime</td>
				<td class="text-nowrap">$CookieType.Title</td>
			</tr>
			<% end_loop %>
		</tbody>
	</table>
</div>

