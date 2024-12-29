import 'package:flutter/material.dart';
import 'package:nota_por_nota/ui/core/themes/colors.dart';

sealed class AppTheme {
  static ThemeData lightTheme = ThemeData(
    useMaterial3: true,
    brightness: Brightness.light,
    colorScheme: AppColors.lightColorScheme,
  );
}
