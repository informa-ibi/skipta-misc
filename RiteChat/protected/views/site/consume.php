<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/
if(is_object($data))
print_r($data);
else if(is_array($data))
print_r($data);
else
echo $data;
?>

<!--<form method="post">
   <textarea rows="10" cols="200" name="SAMLResponse" >PHNhbWxwOlJlc3BvbnNlIElEPSJfYmI4MzAyNGEtYmZhZC00OTlkLWEyN2YtNTE1YWQ4NzM0YzEwIiBWZXJzaW9uPSIyLjAiIElzc3VlSW5zdGFudD0iMjAxNC0wNi0yNlQxOToxMDo1NloiIERlc3RpbmF0aW9uPSJodHRwczovL3JpdGVjaGF0LnNraXB0YXRyaW5pdHkuY29tL3NpdGUvY29uc3VtZSIgeG1sbnM6c2FtbHA9InVybjpvYXNpczpuYW1lczp0YzpTQU1MOjIuMDpwcm90b2NvbCI+PHNhbWw6SXNzdWVyIHhtbG5zOnNhbWw9InVybjpvYXNpczpuYW1lczp0YzpTQU1MOjIuMDphc3NlcnRpb24iPmh0dHBzOi8vcG9ydGFsLnJpdGVhaWQuY29tLzwvc2FtbDpJc3N1ZXI+PHNhbWxwOlN0YXR1cz48c2FtbHA6U3RhdHVzQ29kZSBWYWx1ZT0idXJuOm9hc2lzOm5hbWVzOnRjOlNBTUw6Mi4wOnN0YXR1czpTdWNjZXNzIiAvPjwvc2FtbHA6U3RhdHVzPjxzYW1sOkVuY3J5cHRlZEFzc2VydGlvbiB4bWxuczpzYW1sPSJ1cm46b2FzaXM6bmFtZXM6dGM6U0FNTDoyLjA6YXNzZXJ0aW9uIj48RW5jcnlwdGVkRGF0YSBUeXBlPSJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGVuYyNFbGVtZW50IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMS8wNC94bWxlbmMjIj48RW5jcnlwdGlvbk1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZW5jI2FlczI1Ni1jYmMiIC8+PEtleUluZm8geG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyMiPjxFbmNyeXB0ZWRLZXkgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZW5jIyI+PEVuY3J5cHRpb25NZXRob2QgQWxnb3JpdGhtPSJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGVuYyNyc2EtMV81IiAvPjxLZXlJbmZvIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwLzA5L3htbGRzaWcjIj48WDUwOURhdGE+PFg1MDlDZXJ0aWZpY2F0ZT5NSUlGWmpDQ0JFNmdBd0lCQWdJUUM0aDhjblNmdE1jV2JNM1ZtSzRLbWpBTkJna3Foa2lHOXcwQkFRVUZBREJJTVFzd0NRWURWUVFHRXdKVlV6RVZNQk1HQTFVRUNoTU1SR2xuYVVObGNuUWdTVzVqTVNJd0lBWURWUVFERXhsRWFXZHBRMlZ5ZENCVFpXTjFjbVVnVTJWeWRtVnlJRU5CTUI0WERURTBNRFF3TVRBd01EQXdNRm9YRFRFMU1EUXdOakV5TURBd01Gb3dnWVl4Q3pBSkJnTlZCQVlUQWxWVE1SVXdFd1lEVlFRSUV3eFFaVzV1YzNsc2RtRnVhV0V4RWpBUUJnTlZCQWNUQ1V4aGJtTmhjM1JsY2pFVU1CSUdBMVVFQ2hNTFUydHBjSFJoTENCc2RHUXhEekFOQmdOVkJBc1RCbE5yYVhCMFlURWxNQ01HQTFVRUF3d2NLaTV5YVhSbFkyaGhkQzV6YTJsd2RHRjBjbWx1YVhSNUxtTnZiVENDQVNJd0RRWUpLb1pJaHZjTkFRRUJCUUFEZ2dFUEFEQ0NBUW9DZ2dFQkFMdjR2Ny9PVGZCVXlsWDIxUlFGVXNiQ2tjWitzejIweHExbndzQ0diOXlpZ3FJVjY5NE9VclRueEFBVE9KZkxzMDkrcy93em1xVUp1M09oRVRveFk0UEkxZ3lnaithWHdrT2Zna3BXVFVtM1RFNm4yTUFrUzBxOU1DTVdNSmxnTUxhVTh3ZlVCd25UbE8rbWRQdlE5K3ZjeVFYa2dXZjNDaFVzMmVKZTBRUTY5QS92Ym5jTDdveGhkYmt0Rkp6eGdjVnl1T0dZZHVjaWtBSE5KRXptS09vd0tBNHAyZTh1dnZGN0s5R1htWk95eDNwV00weE8wWVdTb2JhNHhJS3orTTI5a3N2S1B6dXI2NWlwZEJmejdNWlcyM2NUc0xDRDFMckFhRmludWhSY0ZhbUJUVTMvVkp5UTVnczBRZkJBZTk2MjN1K0U4RUJkZnBoVks3Y3d1UWNDQXdFQUFhT0NBZ3N3Z2dJSE1COEdBMVVkSXdRWU1CYUFGSkJ4MnpmcmM4anYzTlVlRXJZMHVpdGFvS2FTTUIwR0ExVWREZ1FXQkJUZnFsN1N0aksybXBSRC9GRTQyajduZWlSZDZUQm5CZ05WSFJFRVlEQmVnaHdxTG5KcGRHVmphR0YwTG5OcmFYQjBZWFJ5YVc1cGRIa3VZMjl0Z2hweWFYUmxZMmhoZEM1emEybHdkR0YwY21sdWFYUjVMbU52YllJaWMzUmhaMmx1Wnk1eWFYUmxZMmhoZEM1emEybHdkR0YwY21sdWFYUjVMbU52YlRBT0JnTlZIUThCQWY4RUJBTUNCYUF3SFFZRFZSMGxCQll3RkFZSUt3WUJCUVVIQXdFR0NDc0dBUVVGQndNQ01HRUdBMVVkSHdSYU1GZ3dLcUFvb0NhR0pHaDBkSEE2THk5amNtd3pMbVJwWjJsalpYSjBMbU52YlM5emMyTmhMV2MxTG1OeWJEQXFvQ2lnSm9Za2FIUjBjRG92TDJOeWJEUXVaR2xuYVdObGNuUXVZMjl0TDNOelkyRXRaelV1WTNKc01FSUdBMVVkSUFRN01Ea3dOd1lKWUlaSUFZYjliQUVCTUNvd0tBWUlLd1lCQlFVSEFnRVdIR2gwZEhCek9pOHZkM2QzTG1ScFoybGpaWEowTG1OdmJTOURVRk13ZUFZSUt3WUJCUVVIQVFFRWJEQnFNQ1FHQ0NzR0FRVUZCekFCaGhob2RIUndPaTh2YjJOemNDNWthV2RwWTJWeWRDNWpiMjB3UWdZSUt3WUJCUVVITUFLR05taDBkSEE2THk5allXTmxjblJ6TG1ScFoybGpaWEowTG1OdmJTOUVhV2RwUTJWeWRGTmxZM1Z5WlZObGNuWmxja05CTG1OeWREQU1CZ05WSFJNQkFmOEVBakFBTUEwR0NTcUdTSWIzRFFFQkJRVUFBNElCQVFCWDc0YWdLdGViZmlHUnFPci9Eb2psaktieU10dXlwb2hoYklPZTJvR1BvN0JzcmNRTEpGRVFxYXVmOVEzR085YVZEQ1VVWjZ0WUNRYzM2WWp6elR2NGZ0bW1yaFJoZW1qb1ZzeDN3c3UxVzdycVVFSTVKNlZ5YlR1YXV4TmRMckJwR2tqRTZsdHVacVVTb2VWZmxOdXVqSEhPejQwTll4SFJ2M2ZPTjFHZm5tcXBITE1EZlArZ0k5cFlZR0RxcTRaSmpaMm9kWlZKRmJENTlhU2VVZng1TUNsdm8vS3NuR2RuNXFnOXdZR1RxbGNCMlE1WXhTVkZlSTRickk5djJlRThxNDRBaGdWV2ZvWVdUU0NXNjd0cFlLWTNOTU1vWC93YVU0d0p3bmtoS2YxYy9wditxSDBBb2VJQXg3di8zeXY4WU5EOSs4VnBLSnhDKytQMUc5S0Y8L1g1MDlDZXJ0aWZpY2F0ZT48L1g1MDlEYXRhPjwvS2V5SW5mbz48Q2lwaGVyRGF0YT48Q2lwaGVyVmFsdWU+U3ZZY3RZVmk5UzFDU2FxeXdOcGI1SG9CRVkrbnhWRnlOdDgxdlhaa0k4bDl0NkpSb05nR2xibkpPWmZiQ2c3ZXBZNWgreFhoK1hJSFpZeDlFeE5Jbmp6d0s5MW1pV25rdGRmeUtCYUV2dHBRazJ2aDZ1UW5XQ2pDbHYvdmNyK29GdGljOEZMcWRpS0dSY2tua21OdjN6MU5xMDg2NUMzZWV1T3RxOEUvUzNhU3NNSEhmcXFNY1FzQ3lDS29RODNmbEduWHJWSE5vTUtCNElqVkswNlNhOUV6bGlwKytLdFhqcWtJbGU5WXR2cU1sTlBLd1duaWd5UlZnWkV0UktZM1RJS1ducE4yRy8vWVpLOE5iMzlKcGl2Mm1NbEFlMFpJZTJxYnBCVnVzZG9JVUFmZmh1aUUzMktXK0VWYkh1YXYrd0QvNzFWUm5LSDB5YStSbHNqQlpnPT08L0NpcGhlclZhbHVlPjwvQ2lwaGVyRGF0YT48L0VuY3J5cHRlZEtleT48L0tleUluZm8+PENpcGhlckRhdGE+PENpcGhlclZhbHVlPjBhTlMzUG96RE5DZHhzTFVXbWtmSmJ6L2t4aGo1RytpZldFL1RhY093NkpwY1k0WUJLUTFwTUpSN3E3SExRMFJiR0pqdjE2cklEYUJFd3QyenNGb1V1TWdVa1VkbHNYeFhuU0tiZ2VRQU83bENMVzFkMUdZMTBRdGNuM1kxRU9kRmJiTlVCd1I3MUt2V2ZLZy96MHYybmdHTTRMS2RRdVkxaExDYUtCSFNjZzVyQTltM2FiMWh0Yk9zQ1RhcGdLQ0JVa2VnUWFCUkJEMXBxbGVJbmROTXVTYmFWZ2M2MWxhcDU4SzkzMmFIV0tJckRpbllReVFwVjliVzV1dm5vQXNEZFM5MEVqaEFhWmo5ejJlSkpsUk5NKy9wZHRVbk45REQ0SXB6a2NFWXJyYjVkWTJqbUZmTkZZU05zZEdrV05DTERBVmp6dlhjSTM5Y1dxaHA1YSs0ejhHd1EzZWlMM1lkSXNtSGNKRk9la1ZzMDVIL3QzRC9HR25hcFplcDlKM2p3RDUyOHJhSVJjanIvSDhRU1FSTERsK2h6UzA3czB1Yld3M1JNS254V292cHY5dXgvbXFlck9PRXRkdXc5NjNiSlNKUEtTU1BrZGlqS1lSU3VXb3BWV1RTWjUrNXhlWU9FWHZkSHlsZ0tGWmx0Ry82cFltblE2RHF3NWtEVFNibEk4ZTNBV3kyVnJOZy9MaEJhNjBsQU80dkdkU09lZXhFekUzVGI3bDVNT3Q0NnhjTGtheGRsVWtUZk1ReDVMU0ZpczNEOUJFdkNVeUZQY1VFMk9ScnFzMEdJWERRTng3UmRMUTgvbFB3WFBicUpkck9NYnNyYm0rVU1qYlNNcHU4c2Y4TExVWmROQy9HZVY1c2gvY3Jwd0lwU2xvRm1kQjRZSWJ6RFZ5MlVpcmJWMjBpbkRXWGlHRGZwc0RLYVB5MVVHaDVyaUF3bGtsbStGeWQ0Z0k2Skc1M1JFYUtSQjE1NWlXeEUxSWpteG9uUnVzZUtVMjFhSWlQZVFldHdOemcremlGOXRVckZDV1Mxd2V6TTV4cXFsdlVpU2FaeS9CbENzYStOT3JvUHR5VVUxdEZKQnFvWGwxZ2hFRk1pdGtQcm1mUTJUSWh0eFNsemVFRGxGcW15MXpvWFZsYWdUcWxvWnhGYWY1Qy80VUhuRG1NcWdMTnZPTlVFU2pxYXdheVhqQ2JZVG5EY1pVYmdPay9LSXl4aXdTU3R4QTAwZDRLZEV5d1Q4V2NFNFNBdTJya0xwUjdYVzJ0NURQRDVXR2tDV3dCU3ptdUFVYkxJeFQ5L3VPMjRmbzU1TEpEMm10NHF3QlhFcVRkOS9vdVNPQWxkSUFHRkhiOVRKWjBOT3FXeFMxeWVyMnA3SmxSV05JRXBYVFY1U3luZ3dqTnM2M0d5L1NubXVqSllaV1RRcVFiNGpHRkk2aC85dytneWg2aFNGNGdsRkI1OENLNXVwS0J2Yk1yVE9OSGFMc0JJb0hITWwvNTZYZXBhczVOT3R1ckJvSGFjQkN2cG9DazdncGpIblZ6WGU5Z1lvS0Z0bUgrTThXK25PUjArTXNuRUFrcEJzVFgzcFZ1TVdmbDFvS24weEFTZjdVZldTRlBRb0lhTlZaTnpoU0I3NmJlcWduTEtwVEo3cWV2RzF5Q3VxMnB3K0N1bWtEWUNkaHZJSTY3UVUxanBxUHdJVW44enZmUEpPK3kxMFIwRXk2NHFsR1BVZGNhdmZsN0J2Y2YzcVg0QUZXaEhjMjZTbHB2bWtFdFVvbTVHbWJvNDdra3h3VDN3QStWSEdMMkdUMEFrTFdLUkVkRy9yTk5oQis1aW91UkJPVmJQZGg2Y252WCtnL1BWNEZJemhBUUh3cGF5TUlpQks4TjBGS0RYa05wQW5ZRzVrYkg1bGpaUEtPNTlQZjU0Y3lRMTV6L0FCaEhGdDk3cmoxUWZpV3dtU1dmNDBCOWt3dXE1KzVpcCt5ajVxaWRtTGVrcWFlR1dhM3d4M1B0bTRDK0hxblZJRGdOV2N2VHZ6R0hZRGJLYzd0OHZmenZmUXpMb1FzdmgwZUNrRGtVT2lkVDhpdXRSbjYzLzhOOG1OVUtUNmJoN3NjLzEvRGRSNk0zdFhucmpCODRWMzJvUnZBeE83RE1sYzRIemlLR2Q1T3krN3BtR2c5dlVjT3ErUWtVMVlmeGFFNjdZeW5PY0ZiSVcwdzFOVUNObVFUSWFMajZ5bTRqc2huSTFNanRtdmNOSGE2QTVIdDhzLzg3cFcwU3AxMlBlWUVKYmZ4cjJnSlNmOWp6MzB0eDVCdnNVY2d6SzF3Kzg5ZnNneGNWcy9mM3pxNmcxZEhYVmJuWVMvN25ZTThlQ3ZoRjh6YnN2RzlWSzg2K3ZoSWJMc0U1d2MxWWlZZ1dKZFlSdEh4QnF5WEs2OU1iN1hCUnI0TkhYT1M2SzV5cE5mVFNrejV5U2J6cS9YQWFwZE0yY1BKVysrUWs4aHVBL0RYY2hzTVBYS0FHVG5XY2RZSlhiTzJmYVp6dUVBa3h1cStSNlZubEVTRGwrZHpoRE9WTEpqOXMrenVROFo0YVlnYlAvZ0EyRGhIYjZJYldmajV4VUdPcmlCQWo2NFJaK0NTVW9VcERRMnNZbzRYQkt4SDlBL2JnZ3d5QWlsNUM5eFZoR3oxUXlrVFV3L0pVRVNJUGJ2OExWY3E2SUtRNXg0eWlVRkFIc2VGTkM2emVwbHRzbXEyZzI3N0NlbkJxV2hwVksrSVRFQnA1Y2hnT3lJa0tKbDJ0dUtFbmlKbnNlTXpkeUlleW12R2EvblpCa1BzMUVJOVpKT0N0bjNNMnZ4SlNYZVZZSHBpOHl2Wk82MURRSVJEWlNDUFhCdWpMRXZUWWhtTjU4ZXFuTTlFTzY5MkE3SFE4Q0tXSU5SbVVnQlZaVkdLVVlUUFM0S050Wk5sNG16ZGpvbVN0MFNmU3FtSFc2WlBVNTQvdkgwYk1nOVJQUVIvZVBPRjdDUnJWc0dWTjlxRnNNaUFaeXRzSjYxT3FpL01YSlY1UlJtdmZCREJsSWp3UjNBeWZmMEJhc2Vadk5TdU5rVTJJampxWVhObFl0ck4yZzkyeWdpWDF1M0MvS0RGanI2N3lYMml0WWRhRXZsVi9FSCttWUpwOExuVXU1Z1R2Vy9VK3Q4SXY2cDliRlpyK3EzYU9NbkQ4OTlGU2VJRlFRcnNuNGdoY3pXaWRjREczdk5PazFKdURMazZyZHNaU0x6ZisyTGlXT1I3Nm5FVjZWWFA4SkdydjJjUFJqVndYYnYyOG42SythWGV0cTZWUVZuNXo2dVMrWi9nOGJPZmQ5QklseXZPdlRScXhjRWlNRmx6aFlKbXdDZUxTVlQxUGQrajh3cUZkQ09Qd3U2WEw1SVJQRkZGUGJVT3ZJNWp4MTdNcHV4blMvOFlqK1ZadEd3VTBzZHI4SlJ1UFYwSXVWTGNCZTdKNktYNlJ4SThMcjMxeFdkc1V4WUEwZFBkUjhLa2NOd2JCNHV4M1N4d2Z2UW1DaU9TaUZtbGJhZ09tV3JhVFBpY2YybmNTeWNibmhETnE4VWtXWFhtVyszTGhvZGRwY1EzdEVXNFVtZVArdFJtMUl1T0t3d1dWc2pySEhnM2RLVmlPVXBaSlNVb3JwcnJLa0dMUG41YStkeDBERVVsRHEyTUlUeVlMdlBNc2d1dVBVN0Z3ZzZlQUFXbWdKdTA2OGZKdUNLbndGNTAyQ1VWUmhVQWRpeG5IM09zU0JqZUN2NWJ0aVN6ZVFVMjdvQ053NTNkeGQ0a0poYk9kcDl1S3U4Z3hZQzlpcUFpTzdUQy85dXQyTkVsRDVsdTRwOGpQQUNGY0FWWDh5b1RxN3ZNWkMxRnpaTUFTU0hkWWkvZUU0VUlrc1BPemlYWFB1MXFPRjl5R1kyelZ0eUNPWVc3NDI2bWVsOG5UNjEwTkpIZkdOdFB0bWRaVWYvakdOZVI3N0plLzQ4S0gxRUZscVZ0MkJ6TmtuYWEzeWNlWkY4a3RGa3UxUkdMQmlrbmdvWmNhS0pQeWM1T3BjZEUzT0p0a1VKM09MVTJLZ0RTSENRd3Q4eWNjMXdTUG02QmcxRWtjbFhwTzRBQklnZUo4QWNMM1VqMVE4WEpvVjM5VHM0bGVYOUlaZTNMdmQxcHVuQ3VKWWlsQW1nVGtGY2lUYzNqTFdrbE9heXZTSU1MVjZrMnlnSmpISi9oZzJqdVdGb2dNN25ZT0svR1QrNmd0aUs4eVAra3RrVjg5NjNwTWNieWxPdFRrakxaUWpaVlk5dVJWSkNTVTBoNmRqcUJnSWczTkQ2SDVEMDlhRGpaY3FnSTVOR1hrU3d4Z3g1T1ZhcHJjL3VQY3ZVbjVMOTVoMEpCblNpYzBKazNXUGYwLzVpVFhiYU5GN0dNY0hnc3E5YkF5QUNUdFRZcStwcmt5U3gxSWdHZUlMSHBhTlNTdVFBUzRaVmU5YTdkd3lIUmRHb05mWEVGS09YSlBtNXBZTVhsSlRmMnBHMjhUKzljRnFRMXlCZHZ3c3ZCbjlYeG9rVFZPZ3cxMHc3c1Nrd2pHOXZEQ3NORm1wTkQraXpNaTZqQjR0YjBodmsxa0d0b3hBWG82MXFJYWlCbHpuN0JWYUNoNWlrUG5ZNDhsZks4ZEFKTkxja0xvdG5nWXNtRmJsMmlHblM3d0Z6WEs3bEYra1RVS0xNR1dyb29zQVlScGo3Yk5iWC9qUlZuWU80SUpLNjVyNjhlc1ZoVU14bU8rRUVxM2FOL1R4bS9nZDMvbHZzL3NhTGlGSHE1anFtbFplMnZNcDFqN050QjB4VlNRcHFJdERjekx2MHNQYy9Wc0NjODdjTEpFZmp2OXZIb0h3eWZPejhWVzFYajFENzJIVnhEamIvc2dZa2RZVEhBbzYzZUVvYnhacDZPZVoxaWlLTDBrckZ3QllUY1hVZlozUkFLa2E1d0NnWEI4a2JxYmpXQXgxSGx1ZXlCUkEvUVVEZW5aSXBwVnFFNko4Z3NpU2hWMDFvUE1MbU5WcWk5c0pSU2g2cFhpUE9iandaSGIrUktwcFhsaERqMTlMZjRqZkRkQzRBRHZaMnlYMFBwVXlrSWtFaDNUUHhQWUhwVVJ0azhNWllEeDdzL0tSM3BDQzIyQUk3djFsakRVRU5BNjZxVXorMjBKSlJWa3hVUEs0WndLM0owMWxoeEZjazhML0VObjhUdmlvNnR0OGwrOU9hSHY1b0NMdWUwTGx6dXd0Y2l0a2lNa01WeXB6WlkxTGNEM0V5clpFR21SanBKbkpMSzNCdERxVUVXWUJTMnpJZjcyS0V1YjlqTnNZaG8yaTh0dEExbGhhdXZ3Mm13S2wrazQ4Tk5LZk4vL3lIZzFOQkZERW8xU1lwR1pnTTNWZFMyd3UzWThUdjBxRlNoY3lHdmVYWi9CSEhtVU53KzV1YWE4SEh3R0swRFpjVDVlUmdLMjVmeTB0OExvS3haQ09EdG1sSWFWamdRSHM3Q2pTRHExWkpWdWduemlGQ2dnbmRveHZJVGVKTG1qNEVmZ0prN1p0OEgxR0lNRFFpN1kzTlM5MmhjL28ydUFjTnNhbWt1YjlYczRrTWlraVU0a3lrZGcySmQraVJnQnpjVlZ6OEp2NEF4Uk9DWnhjQTRZZ2dVZys4ODdWV0hqUk96QzFCQUxNWHlUV2E1Rzl3YUd5dUxsbGR2bi9qZWNyckVxaFoxUzZTN1QyL2Q4b01Ja1I4ZGVJRDl5T3Aya1RlZCtEOHkwakxDY2IrWXBoc2RvUm43U0NJVW9rb1RsM3dSZmdOams0KzIzK0pUcFppZkgxWHhJbmk5L0k1NVVaVE8zRC90dXZZRFAvMndqcWpZQlk0OE9tYnppWEl1WGxJT2RXdjBtN2ZkQThTS3hKc24rcG9ZQ1ZPSnBEL3g5UWt1VHFkc1VuRFRtZVhCWVg3NmJ5bzNJc0pseE5lbWhPMmpZSG9rZGhPL3loLzZpUExpVUFJY1o4THpPMzNzdkpDL0RkRUZ0RDZqakhZbVZTTXF5cUdlMS9zNmNZL1o2bkt3ajRlRHlrdXUxdko3M0tYRWQzZ29ZcEk5WW1Jb21lZW1IVVlKOHFHREJCdHdrTGlqRm5xb1RvSXJOZTBCbXhycHhycVN0cEorNWJlRDZnaDVIQnFtZEhVSkEzR2hpRGtiUkFBdE9Ec2dBazFoMysvWjgvdUEvQVRJZzVETHo5eWZJWnp6Tk1FektQMUlyVXlPYkdQY0JwZ1NmclpEMkh3alo1cHQyM1ZuTWxQWUVHRFhuMDhyVmRFdEZmeEY0NFp6bmNNc2o5aVdrVjZ4V053Q0pHWGNzd1RzYmpGS2lXNEVmUGJvaDhmUnQ0VjQ3NmtlKzA1UGlHYkw2c2hzV0k5czMyUytyeldranA0Rlp6S0p0Z2pxS1BEdDNMUFdLRk1wRGtnZ2JyTllwQTUyNWU4V0tEK3lIQ3NSYzQxZjFpYnBFVWR3UDlPcXdLVS85VnY3M0dVR2YyREpmTDZJNS8xMC9zN3hHRW5FU1g1ZW0vWjZJRU9Mc0t1dmFPQUtEUGR3Y3BUeEtZVmpwa3Y0WlRxNVFuRDNzUHA1NzMvalUzR05lNXlVWWk3ZUgrM21Tb0hWN1ZxUVk3UGUrczdDZG5wekp5bTZvMWJrSGNobzFtQjhlbzBQRExaOEQ5M2JwWGdVbFZJMmxJWktFYTRjVmNCMGtjTGkzc1VFMzFuTUpJNVZONVFzRlUrK3dObEd4d3FhOUpXRlBlMmFScE5NUWVnZDVBUW1mRllTM1ZCbzJSbkplWUs2RmpDd2ZXeU9KU3lHTEF6SUE1SDFpVFBXUEZOMVVZamJkK0tIQWt0blFZTUtCUWJnRDNXRDNEL2RJMWhZMFRvYU1YQm9jQk1OMGsycElPYTBCbWJwVTBzVDZMdmgrT3d5Nm9xc0tyY1VucW8rQ2lVb3RGWllpWjZTZ2JmS04yY2FRNXNsTFFORmtqeE5oMm9TcWZUdkxjNnF5NWluZm50cEg1VXJ5UnpmWDBaSnlOYlBXWlpaVzRkR0xFNjN0R0RzY080bkxSOEo2VkYvb01NNkUvTXR6RDRGQVM2YlZLc3VOanhFa0NrNFBldVhqSWJucEx6dE1aRVRrNzdSam1kYUt5UTJoTzYrUllPQlNDK3VreHg1MzQ2dDlYQyt5SXlkZXBlUkVEMFhaajM1V21IUnp6VWNMMTlSZ213QkdCbHRyL2hSUXhhbHdyNnc1V3pFWUEyUUtFS3p5SnZwSjFNajlFWjJoNzJnZTdBTkpCbzFQSEtIZTJsditoVEE5Q1RFTTJEcVRsSkYrSE1YVE5oalZiL3JOUzRkZHhHT1FsbmJNcE1LRW9uMG5sSHlZQzRwWEZ3NG9UY0pMVHQ1b1ZMcStlU1piRUEzS2ZtQndOd1QwUFc0SENNU2NGNUxiUUxDaHdBdldBeWpyZU1HS1ZoczVBU1BHSGZMcGtoWVNoMXFMK004RU40Qi9TREtFcUVIdEFlSXljNDZpMkFYTzQwd1RNZWQyTXplZ09mdVhzc0lvNkMyYUc4T3p4UWJEUS9uYVdOZVlEdVU4dEpwL3RYVkZqQ2k1SUk3aldxWU5SaXRtSnpGaE0xdzRlRGlEczRYaEZ4OGV4VWd3MTZCSTBsazJUQ21uTHFpYUhVV2hjV1JNeVV1ZkNxTTNyUnF4SXZFdVd6b2JTMVZTZ0hkZzhwTmt2eWVTaGJBVmZlMEt1TnJQYlNmdGZ0T3ZJNUNjNURqTGIzbndaSUYzV0ZHR01qMGRmZHl5dXphcEs4WHZRY0g5RlNKRDdvPTwvQ2lwaGVyVmFsdWU+PC9DaXBoZXJEYXRhPjwvRW5jcnlwdGVkRGF0YT48L3NhbWw6RW5jcnlwdGVkQXNzZXJ0aW9uPjwvc2FtbHA6UmVzcG9uc2U+</textarea>
    <input type="submit">
</form>-->