using System.ComponentModel.DataAnnotations;

namespace app_refresher.ViewModels;

public class LoginViewModel
{
    [Required]
    [StringLength(100)]
    public string Username { get; set; } = string.Empty;

    [Required]
    [DataType(DataType.Password)]
    [StringLength(100)]
    public string Password { get; set; } = string.Empty;

    public string? ReturnUrl { get; set; }
}
